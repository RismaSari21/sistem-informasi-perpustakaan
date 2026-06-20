<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Pustaka Utama</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-[#EFEAF8] via-[#E4DCF3] to-[#D9CEEC] flex items-center justify-center p-4">

    <div class="w-full max-w-[960px] h-[520px] bg-white rounded-[32px] shadow-2xl flex flex-row overflow-hidden border border-white/40">

        <div class="w-[42%] bg-[#D7CBE7] p-8 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-44 h-44 bg-white/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-52 h-52 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex items-center gap-3 z-10">
                <div class="bg-white p-2.5 rounded-xl shadow-sm text-[#6C4E97] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-black text-lg text-[#2F1D4A] tracking-wide leading-none">PUSTAKA UTAMA</h1>
                    <p class="text-[11px] font-bold text-[#593E7D] mt-1.5">Sistem Informasi Perpustakaan</p>
                </div>
            </div>

            <div class="my-auto flex justify-center items-center z-10 w-full">
                <svg class="w-full max-w-[220px] h-auto filter drop-shadow-sm" viewBox="0 0 300 190" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 175 L290 175" stroke="#CBD5E1" stroke-width="2" stroke-linecap="round" />
                    <rect x="25" y="15" width="120" height="160" rx="6" fill="#FFFFFF" stroke="#E2E8F0" stroke-width="1.5" />
                    <line x1="25" y1="55" x2="145" y2="55" stroke="#F1F5F9" stroke-width="1.5" />
                    <line x1="25" y1="95" x2="145" y2="95" stroke="#F1F5F9" stroke-width="1.5" />
                    <line x1="25" y1="135" x2="145" y2="135" stroke="#F1F5F9" stroke-width="1.5" />
                    
                    <rect x="35" y="25" width="14" height="30" rx="1" fill="#FF8A8A" />
                    <rect x="52" y="28" width="12" height="27" rx="1" fill="#FFC93C" />
                    <rect x="67" y="22" width="16" height="33" rx="1" fill="#4D96FF" />
                    <rect x="110" y="28" width="14" height="27" rx="1" fill="#6BCB77" />
                    <rect x="35" y="63" width="15" height="32" rx="1" fill="#4D96FF" /> 
                    <path d="M54 68 L66 95 L78 95 L66 68 Z" fill="#FF8A8A" />
                    <rect x="90" y="65" width="14" height="30" rx="1" fill="#9B5DE5" />
                    <rect x="107" y="60" width="18" height="35" rx="1" fill="#FF9F43" />
                    <rect x="35" y="105" width="18" height="30" rx="1" fill="#00F5D4" />
                    <rect x="56" y="102" width="12" height="33" rx="1" fill="#FF6B6B" /> 
                    <rect x="100" y="107" width="14" height="28" rx="1" fill="#FFC93C" />
                    
                    <path d="M75 15 C72 5, 65 9, 68 15" stroke="#48BB78" stroke-width="2" stroke-linecap="round" />
                    <path d="M85 15 C88 3, 95 7, 92 15" stroke="#48BB78" stroke-width="2" stroke-linecap="round" />
                    <path d="M180 125 C180 105, 200 100, 220 100 C240 100, 275 105, 275 125 L275 160 L180 160 Z" fill="#EBE3F5" />
                    <rect x="170" y="135" width="12" height="25" rx="2" fill="#B299D3" />
                    <rect x="270" y="135" width="12" height="25" rx="2" fill="#B299D3" />
                    <circle cx="215" cy="77" r="11" fill="#4A346B" />
                    <path d="M195 130 C195 102, 210 94, 225 94 C235 94, 250 105, 245 130 Z" fill="#4A346B" />
                    <path d="M220 107 L235 113 L250 107 L248 119 L235 123 L222 119 Z" fill="#FFFFFF" stroke="#B299D3" stroke-width="1.2" />
                </svg>
            </div>

            <div class="bg-white/80 rounded-2xl p-4 border border-white/60 z-10 shadow-sm">
                <h2 class="font-extrabold text-sm text-[#2F1D4A] leading-tight">Perlu Bantuan?</h2>
                <p class="mt-1 text-[#593E7D] text-[11px] leading-relaxed font-medium">
                    Silakan atur ulang kata sandi Anda agar dapat kembali menggunakan fitur layanan perpustakaan digital.
                </p>
            </div>
        </div>

        <div class="w-[58%] bg-white flex flex-col justify-center px-14 lg:px-18 relative">

            <a href="{{ route('login') }}"
               class="absolute top-8 right-10 z-30 flex items-center p-2 text-xs font-bold text-[#6C4E97] hover:text-[#4A346B] transition-colors cursor-pointer select-none">
                ← Kembali Login
            </a>

            <div class="mb-5 mt-4">
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Reset Password</h1>
                <p class="text-gray-400 mt-1 text-xs">Masukkan password baru Anda di bawah ini.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-3.5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required placeholder="nama@email.com"
                           class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] text-xs transition-all bg-gray-50/40 text-gray-700 outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">New Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] text-xs transition-all bg-gray-50/40 text-gray-700 outline-none">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Confirm Password</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••"
                           class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] text-xs transition-all bg-gray-50/40 text-gray-700 outline-none">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 rounded-xl bg-[#6C4E97] hover:bg-[#593E7D] text-white text-xs font-bold shadow-md shadow-purple-100 transition-all transform hover:-translate-y-0.5 cursor-pointer">
                        Reset Password
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>