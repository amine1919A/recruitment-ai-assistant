<x-app-layout>
<div class="min-h-screen bg-[#05060a] text-white relative overflow-hidden">

    <!-- BACKGROUND GLOW -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-180px] left-1/2 w-[600px] h-[600px] -translate-x-1/2 bg-indigo-600/30 blur-[140px] rounded-full"></div>
        <div class="absolute bottom-[-220px] right-[-120px] w-[520px] h-[520px] bg-purple-600/20 blur-[140px] rounded-full"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-12">

        <!-- HEADER -->
        <div class="mb-14">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-xl">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-white/60 text-sm tracking-wide">AI Recruitment SaaS Platform</span>
            </div>

            <h1 class="text-5xl font-extrabold mt-6 bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300 text-transparent bg-clip-text">
                Intelligence Dashboard
            </h1>

            <p class="text-white/50 mt-3 text-lg">
                Analyse, interview et optimisation CV avec une interface SaaS moderne
            </p>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-14">

            @foreach([
                ['cv','CV',$cvs->count(),'from-indigo-500 to-blue-500',
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>'
                ],
                ['interview','Interviews',$interviews->count(),'from-purple-500 to-pink-500',
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 6h16M4 10h16M4 14h10"/>
                    </svg>'
                ],
                ['match','Matches',$matches->count(),'from-green-500 to-emerald-500',
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>'
                ],
                ['opt','Optimisés',optional($optimizedCVs)->count() ?? 0,'from-orange-500 to-yellow-500',
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/>
                    </svg>'
                ]
            ] as [$key,$label,$value,$grad,$icon])

            <div class="group relative p-[1px] rounded-2xl bg-gradient-to-r {{ $grad }}">
                <div class="rounded-2xl bg-white/5 backdrop-blur-2xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300">

                    <div class="flex items-center justify-between">
                        <div class="text-white/80">
                            {!! $icon !!}
                        </div>

                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-5 h-5 text-white/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01"/>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-5 text-4xl font-bold tracking-tight">{{ $value }}</div>
                    <div class="text-white/50 text-sm mt-1">{{ $label }}</div>

                </div>
            </div>

            @endforeach
        </div>

        <!-- ACTIONS -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-14">

            @foreach([
                ['cv','Analyse CV',
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h10M7 15h6"/>
                    </svg>'
                ],
                ['interview','Interview',
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14"/>
                        <rect x="3" y="6" width="10" height="12" rx="2"/>
                    </svg>'
                ],
                ['match','Match',
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>'
                ],
                ['cvbuilder','Builder',
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16"/>
                    </svg>'
                ],
                ['admin','Admin',
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.28 0 4-1.79 4-4s-1.72-4-4-4-4 1.79-4 4 1.72 4 4 4z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 20v-1a6 6 0 0112 0v1"/>
                    </svg>'
                ]
            ] as [$url,$label,$icon])

            <a href="/{{ $url }}"
               class="group relative p-[1px] rounded-2xl bg-gradient-to-r from-white/10 to-white/5 hover:from-indigo-500/40 hover:to-purple-500/40 transition">

                <div class="rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 p-5 text-center hover:bg-white/10 transition-all duration-300">

                    <div class="flex justify-center text-white/70 group-hover:text-white transition">
                        {!! $icon !!}
                    </div>

                    <div class="mt-3 text-sm font-semibold tracking-wide text-white/70 group-hover:text-white">
                        {{ $label }}
                    </div>

                </div>
            </a>

            @endforeach
        </div>

        <!-- LISTS -->
        <div class="grid md:grid-cols-2 gap-6">

            <div class="rounded-2xl bg-white/5 border border-white/10 backdrop-blur-2xl p-6">
                <h3 class="text-lg font-semibold mb-4 text-white/80">Derniers CV</h3>

                <div class="space-y-3">
                    @foreach($cvs->take(5) as $cv)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-indigo-400 rounded-full"></span>
                                <span class="text-white/70 text-sm">{{ basename($cv->file_path) }}</span>
                            </div>
                            <span class="text-xs text-white/40">CV</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-2xl bg-white/5 border border-white/10 backdrop-blur-2xl p-6">
                <h3 class="text-lg font-semibold mb-4 text-white/80">Interviews</h3>

                <div class="space-y-3">
                    @foreach($interviews->take(5) as $i)
                        <div class="p-3 rounded-xl bg-white/5 hover:bg-white/10 transition">
                            <p class="text-white/70 text-sm">
                                {{ \Illuminate\Support\Str::limit($i->question, 60) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
</x-app-layout>