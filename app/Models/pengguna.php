<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;

class Pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penggunas';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'jenis_kelamin',
        'tinggi_badan',
        'berat_badan',
        'alergi',
        'golongan_darah',
        'foto_profile',
        'token_pengguna',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token_pengguna',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'tinggi_badan' => 'decimal:2',
        'berat_badan' => 'decimal:2',
    ];

    /**
     * Generate custom token for login
     */
    public function generateCustomToken()
    {
        $token = bin2hex(random_bytes(32)) . time();
        $this->token_pengguna = $token;
        $this->save();
        
        return $token;
    }

    /**
     * Clear custom token on logout
     */
    public function clearCustomToken()
    {
        $this->token_pengguna = null;
        $this->save();
    }

    /**
     * Get the URL for the profile photo
     */
    public function getFotoProfileUrlAttribute()
    {
        if (!$this->foto_profile) {
            return null;
        }
        
        return url('/profile/' . $this->foto_profile);
    }

    /**
     * Calculate BMI
     */
    public function getBmiAttribute()
    {
        if (!$this->tinggi_badan || !$this->berat_badan) {
            return null;
        }
        
        // Convert cm to m
        $heightInMeters = $this->tinggi_badan / 100;
        $bmi = $this->berat_badan / ($heightInMeters * $heightInMeters);
        
        return round($bmi, 2);
    }

    /**
     * Get BMI category
     */
    public function getBmiCategoryAttribute()
    {
        $bmi = $this->bmi;
        
        if (!$bmi) {
            return null;
        }
        
        if ($bmi < 18.5) return 'Underweight';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Overweight';
        return 'Obesity';
    }

    /**
     * Append calculated attributes to array
     */
    protected $appends = ['foto_profile_url', 'bmi', 'bmi_category'];

    /**
     * Sync user data with Firebase
     */
    public function syncWithFirebase()
    {
        try {
            // In a real implementation, this would sync data with Firebase
            // For now, just log that sync was attempted
            Log::info('Syncing user with Firebase: ' . $this->email);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to sync with Firebase: ' . $e->getMessage());
            return false;
        }
    }
}