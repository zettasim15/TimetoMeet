@extends('layouts.dashboard_member')

@section('content')
<div style="max-width:100%; overflow:hidden;">
    <div style="margin-bottom:1.5rem;">
        <h1 style="font-size:2rem; font-weight:bold; color:#0067ac; margin-bottom:0.5rem;">Presence List</h1>
        <p style="color:#0067ac;">See all your attendance records and submit a new presence below.</p>
    </div>

    <!-- Form Full Width -->
    <form action="{{ route('presence.store') }}" method="POST" enctype="multipart/form-data"
        style="display:flex; flex-direction:column; gap:1rem; background:#d0eaeb; border-radius:1.25rem; box-shadow:0 1px 6px rgba(0,0,0,0.08); padding:2rem; margin-bottom:2.5rem; width:100%;">
        @csrf
        <div style="display:flex; flex-wrap:wrap; gap:1rem;">
            <input type="date" name="tanggal" required
                style="border:1.5px solid #96d3da; border-radius:0.5rem; padding:0.75rem 1.25rem; color:#0067ac; flex:1 1 180px;"
                value="{{ old('tanggal') }}">
            <select name="status" required
                style="border:1.5px solid #96d3da; border-radius:0.5rem; padding:0.75rem 1.25rem; color:#0067ac; flex:1 1 180px;">
                <option value="">Choose status</option>
                <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>Present</option>
                <option value="Tidak Hadir" {{ old('status') == 'Tidak Hadir' ? 'selected' : '' }}>Absent</option>
                <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Excused</option>
            </select>
            <input type="file" name="foto" accept="image/*" required
                style="border:1.5px solid #96d3da; border-radius:0.5rem; padding:0.75rem 1.25rem; background:#e0e0e0; color:#0067ac; flex:2 1 260px;">
        </div>
        <button type="submit"
            style="background:#0067ac; color:#fff; font-weight:600; padding:0.75rem 2rem; border-radius:0.5rem; font-size:1rem; border:none; cursor:pointer; margin-top:1rem; width:fit-content;"
            onmouseover="this.style.background='#38a169'" onmouseout="this.style.background='#0067ac';">
            Add
        </button>
    </form>

    <!-- Table/List Full Width -->
    @if($absensis->count())
        <x-presence_tabel_member :absensis="$absensis" />
    @else
        <div style="background:#d0eaeb; border-radius:1.25rem; box-shadow:0 1px 6px rgba(0,0,0,0.08); padding:2rem; text-align:center; color:#96d3da; font-size:1.15rem;">
            Tidak ada data presensi.
        </div>
    @endif
</div>
@endsection