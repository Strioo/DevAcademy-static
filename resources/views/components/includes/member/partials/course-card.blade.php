<div class="col-md-4 col-12 d-flex justify-content-center my-1 pb-3">
    <div class="card d-block flex-row">
        <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" class="card-img-top  d-block"
        alt="" />
        <div class="card-body">
            <div class="title-card">
                <h5 class="fw-bold truncate-text">Frontend Developer</h5>
            </div>
            <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                {{-- <div class="avatar m-0 fw-bold me-1"> --}}
                    <div class="profile">
                        <img class="me-2" src="{{ asset('devacademy/member/img/icon/Group 7.png') }}" alt="" />
                        Wahid
                    </div>
                    <div class="btn-group-harga d-flex justify-content-between align-items-center">
                        <div class="harga">
                            <div class="d-flex sertifikat">
                                <img class="me-2 icon-serti" id="check-icon"
                                src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                alt="" />
                                <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                            </div>
                            <p class="p-0 m-0 mt-2 price fw-semibold float-end">
                                {{-- @php
                                    $currentBundling = $bundling[$course->id] ?? null;
                                @endphp
                                {{ $currentBundling
                                    ? ($currentBundling->price == 0
                                        ? 'Gratis'
                                        : 'Rp' . number_format($currentBundling->price, 0, ',', '.'))
                                    : ($course->price == 0
                                        ? 'Gratis'
                                        : 'Rp' . number_format($course->price, 0, ',', '.')) }} --}}
                                        Gratis
                            </p>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            <a href="" class="btn btn-primary py-2 mt-3">Mulai Belajar</a>
        </div>
    </div>
</div>
