@extends('layout.admin')

@section('content')
    {{-- Sidebar --}}
    @include('components.sideNavbar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('components.topBarAdmin')
            @livewire('bukurusak')
        </div>
    </div>
@endsection
