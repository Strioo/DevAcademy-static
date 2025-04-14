<div class="col-md-3 d-none d-lg-block p-0">
    <div class="col-md-9 ms-5">
        <div class="sidebar" id="sidebar">
            <h5 class="tittle-sidebar text-center mb-5">Dashboard Saya</h5>
            <div class="profile d-flex">
                @if (Auth::user()->avatar != 'default.png')
                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="avatar"
                        class="avatar class mb-3 rounded-circle" />
                @else
                    <img src="{{ asset('devacademy/member/img/default.png') }}" alt="avatar"
                        class="avatar class mb-3 rounded-circle" />
                @endif
                <div>
                    <p class="name ms-3">{{ Auth::user()->name }}</p>
                    <p class="posisi mt-0 ms-3">{{ Auth::user()->profession }}</p>
                </div>
            </div>
            <div class="menu">
                <ul class="side-tabs d-flex flex-column gap-2">
                    <li><a href="{{ route('member.dashboard') }}"><img class="ms-2"
                                src="{{ asset('devacademy/components/member/img/Frame 8.png') }}" alt="icon">Kelas
                            Saya</a></li>
                    <li><a href="{{ route('member.transaction') }}"><img class="ms-2"
                                src="{{ asset('devacademy/components/member/img/Frame 10.png') }}"
                                alt="icon">Transaksi
                            Saya</a></li>
                    <li><a href="{{ route('member.setting') }}"><img class="ms-2"
                                src="{{ asset('devacademy/components/member/img/Frame 11.png') }}"
                                alt="icon">Pengaturan</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
