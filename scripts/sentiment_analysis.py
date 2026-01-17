import sys
import os
import pandas as pd
import numpy as np
import mysql.connector
from mysql.connector import Error
from dotenv import load_dotenv
import json
from datetime import datetime
import re
import traceback

# Set working directory
os.chdir(os.path.dirname(os.path.abspath(__file__)))

# Setup logging untuk debug
import logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('sentiment_analysis.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

try:
    from sklearn.feature_extraction.text import TfidfVectorizer
    from sklearn.linear_model import LogisticRegression
    from sklearn.model_selection import train_test_split
    from sklearn.metrics import classification_report, accuracy_score
    import joblib
    import nltk
    from nltk.tokenize import word_tokenize
    from nltk.corpus import stopwords
    from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
    
    logger.info("Semua library berhasil diimport")
except ImportError as e:
    logger.error(f"Error importing libraries: {e}")
    sys.exit(1)

# Tambahkan path ke NLTK data
nltk_data_path = os.path.join(os.getcwd(), 'nltk_data')
nltk.data.path.append(nltk_data_path)

# Download NLTK resources jika belum ada
try:
    nltk.data.find('tokenizers/punkt')
    logger.info("NLTK data sudah ada")
except LookupError:
    logger.info("Mengunduh data NLTK...")
    try:
        nltk.download('punkt', download_dir=nltk_data_path, quiet=True)
        nltk.download('stopwords', download_dir=nltk_data_path, quiet=True)
        logger.info("Data NLTK berhasil diunduh")
    except Exception as e:
        logger.error(f"Error downloading NLTK data: {e}")

# Load environment variables dari file .env Laravel
env_path = r'C:\xampp\htdocs\gym-api\.env'
if os.path.exists(env_path):
    load_dotenv(env_path)
    logger.info("Environment file loaded successfully")
else:
    logger.error(f"Environment file not found at {env_path}")
    print(json.dumps({
        'status': 'error',
        'message': f'Environment file not found at {env_path}',
        'data': [],
        'summary': {},
        'mrr': 0
    }))
    sys.exit(1)

class SentimentAnalyzer:
    def __init__(self):
        logger.info("Initializing SentimentAnalyzer...")
        self.db_config = {
            'host': os.getenv('DB_HOST', '127.0.0.1'),
            'port': os.getenv('DB_PORT', '3306'),
            'database': os.getenv('DB_DATABASE', 'gym_api'),
            'user': os.getenv('DB_USERNAME', 'root'),
            'password': os.getenv('DB_PASSWORD', '')
        }
        
        logger.info(f"Database config: {self.db_config['host']}:{self.db_config['port']}/{self.db_config['database']}")
        
        # Inisialisasi stemmer untuk Bahasa Indonesia
        try:
            factory = StemmerFactory()
            self.stemmer = factory.create_stemmer()
            logger.info("Stemmer initialized successfully")
        except Exception as e:
            logger.error(f"Error initializing stemmer: {e}")
            self.stemmer = None
        
        # Stopwords Bahasa Indonesia
        try:
            self.stop_words = set(stopwords.words('indonesian'))
            logger.info(f"Loaded {len(self.stop_words)} stopwords")
        except Exception as e:
            logger.error(f"Error loading stopwords: {e}")
            self.stop_words = set(['yang', 'dan', 'di', 'dari', 'ke', 'pada', 'untuk', 'dengan', 'ini', 'itu', 'saya', 'kamu'])
        
        # Model dan vectorizer
        self.vectorizer = TfidfVectorizer(max_features=1000, ngram_range=(1, 2))
        self.model = LogisticRegression(max_iter=1000, random_state=42)
        
        # Model path
        self.model_dir = os.path.join(os.getcwd(), 'models')
        os.makedirs(self.model_dir, exist_ok=True)
        
        self.vectorizer_path = os.path.join(self.model_dir, 'vectorizer.pkl')
        self.model_path = os.path.join(self.model_dir, 'sentiment_model.pkl')
        
        logger.info(f"Model directory: {self.model_dir}")
    
    def connect_to_database(self):
        """Koneksi ke database MySQL"""
        try:
            connection = mysql.connector.connect(**self.db_config)
            if connection.is_connected():
                logger.info("Berhasil terhubung ke database")
                return connection
        except Error as e:
            logger.error(f"Error koneksi database: {e}")
            return None
    
    def fetch_feedback_data(self):
        """Ambil data feedback dari database"""
        logger.info("Mengambil data feedback dari database...")
        connection = self.connect_to_database()
        if not connection:
            logger.error("Gagal terhubung ke database")
            return pd.DataFrame()
        
        try:
            query = """
            SELECT 
                f.id,
                f.rating,
                f.review,
                f.created_at,
                p.nama_lengkap,
                p.email
            FROM feedbacks f
            LEFT JOIN penggunas p ON f.id_pengguna = p.id
            WHERE f.review IS NOT NULL AND f.review != ''
            ORDER BY f.created_at DESC
            """
            
            df = pd.read_sql(query, connection)
            logger.info(f"Berhasil mengambil {len(df)} data feedback")
            return df
            
        except Error as e:
            logger.error(f"Error mengambil data: {e}")
            return pd.DataFrame()
        finally:
            if connection and connection.is_connected():
                connection.close()
                logger.info("Koneksi database ditutup")
    
    def preprocess_text(self, text):
        """Preprocessing teks Bahasa Indonesia"""
        if not isinstance(text, str) or not text:
            return ""
        
        try:
            # Lowercase
            text = text.lower()
            
            # Hapus karakter khusus dan angka
            text = re.sub(r'[^\w\s]', ' ', text)
            text = re.sub(r'\d+', ' ', text)
            
            # Tokenisasi
            tokens = word_tokenize(text)
            
            # Hapus stopwords dan stemming
            cleaned_tokens = []
            for word in tokens:
                if word not in self.stop_words and len(word) > 2:
                    if self.stemmer:
                        stemmed_word = self.stemmer.stem(word)
                    else:
                        stemmed_word = word
                    cleaned_tokens.append(stemmed_word)
            
            return ' '.join(cleaned_tokens)
        except Exception as e:
            logger.error(f"Error preprocessing text: {e}")
            return text.lower() if text else ""
    
    def label_sentiment_by_rating(self, rating):
        """Label sentimen berdasarkan rating"""
        try:
            rating = int(rating)
            if rating >= 4:
                return 'positive'
            elif rating == 3:
                return 'neutral'
            else:
                return 'negative'
        except:
            return 'neutral'
    
    def calculate_mrr(self, df):
        """Hitung Mean Reciprocal Rank (MRR)"""
        if df.empty:
            return 0
        
        try:
            # Contoh peringkat berdasarkan rating (simulasi ranking)
            df_sorted = df.sort_values('rating', ascending=False)
            df_sorted['rank'] = range(1, len(df_sorted) + 1)
            
            # Hitung MRR sederhana
            mrr = (1 / df_sorted['rank']).mean()
            return round(mrr, 4)
        except Exception as e:
            logger.error(f"Error calculating MRR: {e}")
            return 0
    
    def prepare_training_data(self, df):
        """Persiapkan data training"""
        # Label sentimen berdasarkan rating
        df['sentiment_label'] = df['rating'].apply(self.label_sentiment_by_rating)
        
        # Preprocessing teks
        logger.info("Memproses teks review...")
        df['cleaned_review'] = df['review'].apply(self.preprocess_text)
        
        return df
    
    def train_model(self, df):
        """Train model sentiment analysis"""
        if len(df) < 3:
            logger.warning("Data training terlalu sedikit.")
            return False
        
        try:
            # Persiapkan data training
            df = self.prepare_training_data(df)
            
            # Filter hanya positive dan negative untuk training
            df_train = df[df['sentiment_label'].isin(['positive', 'negative'])]
            
            if len(df_train) < 2:
                logger.warning("Data training untuk positive/negative terlalu sedikit.")
                return False
            
            logger.info(f"Training model dengan {len(df_train)} data...")
            
            # Vectorize text
            X = self.vectorizer.fit_transform(df_train['cleaned_review'])
            y = df_train['sentiment_label']
            
            # Split data jika cukup data
            if len(df_train) >= 4:
                X_train, X_test, y_train, y_test = train_test_split(
                    X, y, test_size=0.2, random_state=42, stratify=y
                )
            else:
                X_train, y_train = X, y
                X_test, y_test = X, y
            
            # Train model
            self.model.fit(X_train, y_train)
            
            # Evaluate jika ada test data
            if len(X_test) > 0:
                y_pred = self.model.predict(X_test)
                accuracy = accuracy_score(y_test, y_pred)
                logger.info(f"Model Accuracy: {accuracy:.2%}")
            
            # Save model
            joblib.dump(self.vectorizer, self.vectorizer_path)
            joblib.dump(self.model, self.model_path)
            
            logger.info(f"Model disimpan di: {self.model_path}")
            return True
            
        except Exception as e:
            logger.error(f"Error training model: {e}")
            traceback.print_exc()
            return False
    
    def analyze_sentiments(self, df):
        """Analisis sentimen pada data feedback"""
        results = []
        
        if len(df) == 0:
            return results
        
        # Coba load model yang sudah ada
        model_loaded = False
        try:
            if os.path.exists(self.vectorizer_path) and os.path.exists(self.model_path):
                logger.info("Memuat model yang sudah ada...")
                self.vectorizer = joblib.load(self.vectorizer_path)
                self.model = joblib.load(self.model_path)
                model_loaded = True
            else:
                logger.info("Training model baru...")
                if self.train_model(df):
                    model_loaded = True
        except Exception as e:
            logger.error(f"Error loading/training model: {e}")
            model_loaded = False
        
        # Preprocess data
        df = self.prepare_training_data(df)
        
        # Analisis sentimen
        logger.info("Menganalisis sentimen...")
        for idx, row in df.iterrows():
            try:
                review_text = row['cleaned_review']
                
                if review_text and len(review_text.strip()) > 0 and model_loaded:
                    # Vectorize dan prediksi menggunakan model
                    X_vec = self.vectorizer.transform([review_text])
                    sentiment = self.model.predict(X_vec)[0]
                    probability = self.model.predict_proba(X_vec)[0]
                    
                    # Get probabilities
                    classes = self.model.classes_
                    prob_dict = {cls: prob for cls, prob in zip(classes, probability)}
                    
                    results.append({
                        'feedback_id': int(row['id']),
                        'user_name': row['nama_lengkap'] if pd.notnull(row['nama_lengkap']) else 'Unknown',
                        'email': row['email'] if pd.notnull(row['email']) else '',
                        'original_review': row['review'],
                        'rating': int(row['rating']),
                        'sentiment': sentiment,
                        'probability': {
                            'positive': float(prob_dict.get('positive', 0)) if 'positive' in classes else 0,
                            'negative': float(prob_dict.get('negative', 0)) if 'negative' in classes else 0,
                            'neutral': float(prob_dict.get('neutral', 0)) if 'neutral' in classes else 0
                        },
                        'review_date': row['created_at'].strftime('%Y-%m-%d %H:%M:%S') if pd.notnull(row['created_at']) else None
                    })
                else:
                    # Gunakan rule-based analysis
                    sentiment = self.label_sentiment_by_rating(row['rating'])
                    results.append({
                        'feedback_id': int(row['id']),
                        'user_name': row['nama_lengkap'] if pd.notnull(row['nama_lengkap']) else 'Unknown',
                        'email': row['email'] if pd.notnull(row['email']) else '',
                        'original_review': row['review'],
                        'rating': int(row['rating']),
                        'sentiment': sentiment,
                        'probability': {
                            'positive': 0.8 if sentiment == 'positive' else 0.1,
                            'negative': 0.8 if sentiment == 'negative' else 0.1,
                            'neutral': 0.8 if sentiment == 'neutral' else 0.1
                        },
                        'review_date': row['created_at'].strftime('%Y-%m-%d %H:%M:%S') if pd.notnull(row['created_at']) else None
                    })
                    
            except Exception as e:
                logger.error(f"Error analyzing review {row['id']}: {e}")
                # Fallback to rule-based
                sentiment = self.label_sentiment_by_rating(row['rating'])
                results.append({
                    'feedback_id': int(row['id']),
                    'user_name': row['nama_lengkap'] if pd.notnull(row['nama_lengkap']) else 'Unknown',
                    'email': row['email'] if pd.notnull(row['email']) else '',
                    'original_review': row['review'],
                    'rating': int(row['rating']),
                    'sentiment': sentiment,
                    'probability': {
                        'positive': 0.8 if sentiment == 'positive' else 0.1,
                        'negative': 0.8 if sentiment == 'negative' else 0.1,
                        'neutral': 0.8 if sentiment == 'neutral' else 0.1
                    },
                    'review_date': row['created_at'].strftime('%Y-%m-%d %H:%M:%S') if pd.notnull(row['created_at']) else None
                })
        
        return results
    
    def run_analysis(self):
        """Jalankan analisis sentimen lengkap"""
        try:
            logger.info("\n" + "="*50)
            logger.info("MEMULAI ANALISIS SENTIMEN")
            logger.info("="*50)
            
            # Ambil data dari database
            df = self.fetch_feedback_data()
            
            if df.empty:
                logger.warning("Tidak ada data feedback yang ditemukan.")
                return {
                    'status': 'success',
                    'message': 'Tidak ada data feedback yang ditemukan untuk dianalisis.',
                    'data': [],
                    'summary': {
                        'total_feedback': 0,
                        'with_review': 0,
                        'without_review': 0,
                        'sentiment_distribution': {},
                        'average_rating': 0,
                        'analysis_date': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
                    },
                    'mrr': 0
                }
            
            logger.info(f"Menemukan {len(df)} feedback untuk dianalisis.")
            
            # Analisis sentimen
            sentiment_results = self.analyze_sentiments(df)
            
            # Hitung MRR
            mrr_score = self.calculate_mrr(df)
            
            # Buat summary
            summary = {
                'total_feedback': len(df),
                'with_review': len(df[df['review'].notnull() & (df['review'] != '')]),
                'without_review': len(df[df['review'].isnull() | (df['review'] == '')]),
                'sentiment_distribution': {},
                'average_rating': float(df['rating'].mean()) if len(df) > 0 else 0,
                'analysis_date': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
            }
            
            if sentiment_results:
                sentiments = [r['sentiment'] for r in sentiment_results if r['sentiment'] not in ['no_review', 'unknown']]
                if sentiments:
                    from collections import Counter
                    sentiment_counts = Counter(sentiments)
                    summary['sentiment_distribution'] = dict(sentiment_counts)
            
            # Hasil akhir
            result = {
                'status': 'success',
                'message': f'Analisis sentimen berhasil. {len(sentiment_results)} feedback dianalisis.',
                'data': sentiment_results,
                'summary': summary,
                'mrr': float(mrr_score)
            }
            
            # Simpan hasil ke file JSON
            output_file = os.path.join(self.model_dir, 'sentiment_results.json')
            with open(output_file, 'w', encoding='utf-8') as f:
                json.dump(result, f, ensure_ascii=False, indent=2)
            
            logger.info("\n" + "="*50)
            logger.info("ANALISIS SENTIMEN SELESAI")
            logger.info("="*50)
            logger.info(f"Total feedback: {len(df)}")
            logger.info(f"Feedback positif: {summary['sentiment_distribution'].get('positive', 0)}")
            logger.info(f"Feedback negatif: {summary['sentiment_distribution'].get('negative', 0)}")
            logger.info(f"Feedback netral: {summary['sentiment_distribution'].get('neutral', 0)}")
            logger.info(f"MRR Score: {mrr_score:.4f}")
            logger.info(f"Hasil disimpan di: {output_file}")
            logger.info("="*50)
            
            return result
            
        except Exception as e:
            logger.error(f"Error dalam analisis: {e}")
            traceback.print_exc()
            return {
                'status': 'error',
                'message': f'Error: {str(e)}',
                'data': [],
                'summary': {},
                'mrr': 0
            }

def main():
    """Fungsi utama"""
    try:
        analyzer = SentimentAnalyzer()
        result = analyzer.run_analysis()
        
        # Hanya output JSON untuk Laravel
        print(json.dumps(result, ensure_ascii=False))
        
    except Exception as e:
        error_result = {
            'status': 'error',
            'message': f'Critical error: {str(e)}',
            'data': [],
            'summary': {},
            'mrr': 0
        }
        print(json.dumps(error_result, ensure_ascii=False))
        sys.exit(1)

if __name__ == "__main__":
    main()