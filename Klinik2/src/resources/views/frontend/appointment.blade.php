@extends('layouts.app')

@section('title', 'Appointment | Klinik Bersama')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Buat Janji Temu di Klinik Bersama</h2>
    <p class="text-center mb-5">Silakan isi formulir di bawah ini untuk membuat janji dengan dokter kami.</p>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('appointment.store') }}" method="POST" class="mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $appointment->name }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $appointment->email }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">No. Telepon</label>
            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
            @error('mobile')
                <div class="invalid-feedback">{{ $appointment->mobile }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dokter" class="form-label">Pilih Dokter</label>
            <select class="form-select @error('doctor') is-invalid @enderror" id="doctor" name="doctor" required>
                <option value="" disabled {{ old('doctor') ? '' : 'selected' }}>-- Pilih Dokter --</option>
                <option value="1" {{ old('doctor') == '1' ? 'selected' : '' }}>Rizky Dwi</option>
                <option value="2" {{ old('doctor') == '2' ? 'selected' : '' }}>Muhammad Arifin</option>
                <option value="3" {{ old('doctor') == '3' ? 'selected' : '' }}>Putra Daffa</option>
            </select>
            @error('doctor')
                <div class="invalid-feedback">{{ $appointment->doctor }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal Janji Temu</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $appointment->date }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Waktu Janji Temu</label>
            <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time') }}" required>
            @error('time')
                <div class="invalid-feedback">{{ $appointment->time }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="form-label">Keluhan atau Deskripsi Masalah</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $appointment->message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                Booking Sekarang <i class="fa fa-calendar-check ms-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
