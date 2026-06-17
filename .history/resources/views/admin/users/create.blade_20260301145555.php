@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')
@section('page-description', 'Password akan di-generate otomatis')

@section('content')

<div class="max-w-lg">

    {{-- CARD --}}
    <div class="glass-card p-8">

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="mb-5 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
            @csrf

            {{-- NAMA --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
                    Nama Lengkap <span class="text-red-400">*</span>
                </label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    class="block w-full px-4 py-3 rounded-xl border border-white/[0.06] bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition-all text-sm" />
            </div>

            {{-- EMAIL --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">
                    Email <span class="text-red-400">*</span>
                </label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                    placeholder="email@contoh.com"
                    class="block w-full px-4 py-3 rounded-xl border border-white/[0.06] bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition-all text-sm" />
            </div>

            {{-- ROLE --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-300 mb-2">
                    Role <span class="text-red-400">*</span>
                </label>
                <select id="role" name="role" required
                    class="block w-full px-4 py-3 rounded-xl border border-white/[0.06] bg-white/[0.04] text-white focus:bg-white/[0.08] focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition-all text-sm">
                    <option value="" class="bg-slate-900">Pilih role...</option>
                    <option value="staff" class="bg-slate-900" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="security" class="bg-slate-900" {{ old('role') === 'security' ? 'selected' : '' }}>Security</option>
                    <option value="super_admin" class="bg-slate-900" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>

            {{-- POSITION (optional, for staff) --}}
            <div id="positionField" class="hidden">
                <label for="position" class="block text-sm font-semibold text-slate-300 mb-2">
                    Jabatan / Posisi
                </label>
                <input type="text" id="position" name="position" value="{{ old('position') }}"
                    placeholder="Contoh: Kepala Bagian, Guru, dll"
                    class="block w-full px-4 py-3 rounded-xl border border-white/[0.06] bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition-all text-sm" />
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.users.index') }}"
                   class="flex-1 text-center bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.06] text-slate-300 py-3 rounded-xl font-semibold transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-500 text-white py-3 rounded-xl font-semibold transition shadow-lg shadow-blue-600/20">
                    Buat User
                </button>
            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById('role').addEventListener('change', function() {
    document.getElementById('positionField').classList.toggle('hidden', this.value !== 'staff');
});
if (document.getElementById('role').value === 'staff') {
    document.getElementById('positionField').classList.remove('hidden');
}
</script>
@endpush
