@extends('layout.main')

@section('style')
<style>
    body {
        background: url('/assets/images/pustaka-soeman-hs.jpeg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 0;
    }
    .card {
        width: 100%;
        max-width: 1200px;
        height: 95vh;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
    }
    .card-body {
        overflow-y: auto; /* Membuat konten di dalam card bisa discroll */
        flex-grow: 1; /* Membuat body card fleksibel agar memenuhi ruang */
        padding: 30px; 
    }
</style>
@endsection

@section('content')
<div class="overlay"></div>
<div class="card shadow py-3 px-3 rounded-3">
    <div class="card-body">

        {{-- Logo --}}
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ asset('/assets/images/tut-wuri-handayani.png') }}" alt="Logo" width="80" height="80">
        </div>

        {{-- Judul Card --}}
        <h4 class="text-center mb-4">Tutorial Mendapatkan Chat ID Telegram</h4>

        {{-- Step 1 --}}
        <div class="row p-4 border border-3 border-primary border-opacity-50 rounded-4 mb-4">
            <div class="col-6">
                <img src="{{ asset('/assets/images/Chat-ID-Step-1.jpg') }}" alt="Chat-ID-Step-1" width="100%">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="border border-3 border-primary border-opacity-50 rounded-circle d-flex justify-content-center align-items-center fw-semibold text-primary mb-3" style="width: 50px; height: 50px;">1</div>
                <p class="fs-5">Buka aplikasi Telegram di smartphone Anda, lalu lakukan pencarian dengan keyword "<strong>@get_id_bot</strong>". Kemudian klik untuk membuka bot-nya</p>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="row p-4 border border-3 border-primary border-opacity-50 rounded-4 mb-4">
            <div class="col-6 text-center">
                <img src="{{ asset('/assets/images/Chat-ID-Step-2.jpg') }}" alt="Chat-ID-Step-2" width="50%">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="border border-3 border-primary border-opacity-50 rounded-circle d-flex justify-content-center align-items-center fw-semibold text-primary mb-3" style="width: 50px; height: 50px;">2</div>
                <p class="fs-5">Setelah bot-nya terbuka, klik <strong>Start</strong> atau <strong>Mulai</strong>.</p>
            </div>
        </div>
        
        {{-- Step 3 --}}
        <div class="row p-4 border border-3 border-primary border-opacity-50 rounded-4 mb-5">
            <div class="col-6 text-center">
                <img src="{{ asset('/assets/images/Chat-ID-Step-3.jpg') }}" alt="Chat-ID-Step-3" width="100%">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="border border-3 border-primary border-opacity-50 rounded-circle d-flex justify-content-center align-items-center fw-semibold text-primary mb-3" style="width: 50px; height: 50px;">3</div>
                <p class="fs-5">Catat <strong>Chat ID Telegram</strong> Anda.</p>
            </div>
        </div>
        
        {{-- Judul --}}
        <h4 class="text-center my-4">Tutorial Aktivasi Notifikasi Telegram</h4>

        {{-- Step 1 --}}
        <div class="row p-4 border border-3 border-primary border-opacity-50 rounded-4 mb-4">
            <div class="col-6">
                <img src="{{ asset('/assets/images/Aktivasi-Bot-Step-1.jpg') }}" alt="Aktivasi-Bot-Step-1" width="100%">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="border border-3 border-primary border-opacity-50 rounded-circle d-flex justify-content-center align-items-center fw-semibold text-primary mb-3" style="width: 50px; height: 50px;">1</div>
                <p class="fs-5">Buka aplikasi Telegram di smartphone Anda, lalu lakukan pencarian dengan keyword "<strong>@pustakasma3bot</strong>". Kemudian klik untuk membuka bot-nya</p>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="row p-4 border border-3 border-primary border-opacity-50 rounded-4 mb-4">
            <div class="col-6 text-center">
                <img src="{{ asset('/assets/images/Aktivasi-Bot-Step-2.jpg') }}" alt="Aktivasi-Bot-Step-2" width="50%">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="border border-3 border-primary border-opacity-50 rounded-circle d-flex justify-content-center align-items-center fw-semibold text-primary mb-3" style="width: 50px; height: 50px;">2</div>
                <p class="fs-5">Setelah bot-nya terbuka, klik <strong>Start</strong> atau <strong>Mulai</strong>. Selesai.</p>
            </div>
        </div>
    </div>
</div>
@endsection