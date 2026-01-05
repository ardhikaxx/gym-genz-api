<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register new pengguna
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas',
            'password' => 'required|string|min:8|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:300',
            'alergi' => 'nullable|string|max:500',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle profile photo upload
        $fotoProfileName = null;
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $fotoProfileName = time() . '_' . Str::slug($request->nama_lengkap) . '.' . $file->getClientOriginalExtension();
            
            // Save to public/profile directory
            $file->move(public_path('profile'), $fotoProfileName);
        }

        $pengguna = Pengguna::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'alergi' => $request->alergi,
            'golongan_darah' => $request->golongan_darah,
            'foto_profile' => $fotoProfileName,
        ]);

        // Generate custom token
        $customToken = $pengguna->generateCustomToken();
        
        // Generate Sanctum token
        $sanctumToken = $pengguna->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => [
                'pengguna' => $pengguna,
                'token' => $sanctumToken,
                'custom_token' => $customToken,
                'bmi' => $pengguna->bmi,
                'bmi_category' => $pengguna->bmi_category,
            ]
        ], 201);
    }

    /**
     * Login pengguna
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if (!$pengguna || !Hash::check($request->password, $pengguna->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Generate custom token
        $customToken = $pengguna->generateCustomToken();
        
        // Generate Sanctum token
        $sanctumToken = $pengguna->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'pengguna' => $pengguna,
                'token' => $sanctumToken,
                'custom_token' => $customToken,
                'bmi' => $pengguna->bmi,
                'bmi_category' => $pengguna->bmi_category,
            ]
        ]);
    }

    /**
     * Logout pengguna
     */
    public function logout(Request $request)
    {
        // Clear custom token
        $request->user()->clearCustomToken();
        
        // Revoke Sanctum token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    /**
     * Get authenticated pengguna profile
     */
    public function profile(Request $request)
    {
        $pengguna = Pengguna::all();
        
        return response()->json([
            'success' => true,
            'data' => [
                'pengguna' => $pengguna,
            ]
        ]);
    }

    /**
     * Update pengguna profile
     */
    public function updateProfile(Request $request)
    {
        $pengguna = $request->user();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:penggunas,email,' . $pengguna->id,
            'jenis_kelamin' => 'sometimes|in:L,P',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:300',
            'alergi' => 'nullable|string|max:500',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle profile photo upload
        if ($request->hasFile('foto_profile')) {
            // Delete old photo if exists
            if ($pengguna->foto_profile && file_exists(public_path('profile/' . $pengguna->foto_profile))) {
                unlink(public_path('profile/' . $pengguna->foto_profile));
            }
            
            $file = $request->file('foto_profile');
            $fotoProfileName = time() . '_' . Str::slug($request->nama_lengkap ?? $pengguna->nama_lengkap) . '.' . $file->getClientOriginalExtension();
            
            // Save to public/profile directory
            $file->move(public_path('profile'), $fotoProfileName);
            $pengguna->foto_profile = $fotoProfileName;
        }

        // Update fields
        $pengguna->fill($request->only([
            'nama_lengkap',
            'email',
            'jenis_kelamin',
            'tinggi_badan',
            'berat_badan',
            'alergi',
            'golongan_darah',
        ]));

        $pengguna->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diperbarui',
            'data' => [
                'pengguna' => $pengguna,
                'bmi' => $pengguna->bmi,
                'bmi_category' => $pengguna->bmi_category,
            ]
        ]);
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $pengguna = $request->user();

        // Check current password
        if (!Hash::check($request->current_password, $pengguna->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah'
            ], 401);
        }

        // Update password
        $pengguna->password = Hash::make($request->new_password);
        $pengguna->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah'
        ]);
    }

    /**
     * Login with custom token
     */
    public function loginWithCustomToken(Request $request)
    {
        $request->validate([
            'custom_token' => 'required|string',
        ]);

        $pengguna = Pengguna::where('token_pengguna', $request->custom_token)->first();

        if (!$pengguna) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau telah kadaluarsa'
            ], 401);
        }

        // Generate new Sanctum token
        $sanctumToken = $pengguna->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login dengan token berhasil',
            'data' => [
                'pengguna' => $pengguna,
                'token' => $sanctumToken,
                'custom_token' => $pengguna->token_pengguna,
                'bmi' => $pengguna->bmi,
                'bmi_category' => $pengguna->bmi_category,
            ]
        ]);
    }

    /**
     * Delete account
     */
    public function deleteAccount(Request $request)
    {
        $pengguna = $request->user();
        
        // Delete profile photo if exists
        if ($pengguna->foto_profile && file_exists(public_path('profile/' . $pengguna->foto_profile))) {
            unlink(public_path('profile/' . $pengguna->foto_profile));
        }
        
        // Revoke all tokens
        $pengguna->tokens()->delete();
        
        // Delete pengguna
        $pengguna->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil dihapus'
        ]);
    }
}