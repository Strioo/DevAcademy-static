@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Kursus')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kursus</h6>
                    <a href="{{ route('admin.course.create') }}" class="btn btn-primary">Tambahkan Kursus</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (Auth::user()->role == 'superadmin')
                                    <th>Pembuat Kelas</th>
                                @endif
                                <th>Kategori Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Cover Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Level</th>
                                <th>Tools</th>
                                <th>Deskripsi Singkat</th>
                                <th>Deskripsi Panjang</th>
                                <th>Link Asset</th>
                                <th>Link Grup</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    @if (Auth::user()->role == 'superadmin')
                                        <td>{{ $course->users->name }}</td>
                                    @endif
                                    <td>{{ $course->category }}</td>
                                    <td>{{ $course->type === 'premium' ? 'Berbayar' : 'Gratis' }}</td>
                                    <td>
                                        @if ($course->cover && $course->cover != '' && file_exists(public_path('storage/images/covers/' . $course->cover)))
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                alt="Cover Kelas {{ $course->name }}"
                                                style="width: 100px; height: auto; border-radius: 5px;">
                                        @else
                                            <img src="{{ asset('devacademy/member/img/courseBG.png') }}"
                                                alt="Default Cover"
                                                style="width: 100px; height: auto; border-radius: 5px;">
                                        @endif
                                    </td>

                                    <td>{{ $course->name }}</td>
                                    <td>
                                        {{ ['beginner' => 'Mudah', 'intermediate' => 'Menengah', 'expert' => 'Sulit'][$course->level] ?? '-' }}
                                    </td>
                                    <td>
                                        <ul class="p-0 list-unstyled">
                                            @foreach ($course->tools as $tool)
                                                <li>{{ $tool->name_tools }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $course->sort_description }}</td>
                                    <td>{{ $course->long_description }}</td>
                                    <td class="{{ $course->link_resources ? 'text-success' : 'text-danger' }}">
                                        {{ $course->link_resources ? 'Ada' : 'Belum Ada' }}
                                    </td>
                                    <td class="{{ $course->link_groups ? 'text-success' : 'text-danger' }}">
                                        {{ $course->link_groups ? 'Ada' : 'Belum Ada' }}
                                    </td>
                                    <td class="{{ $course->status === 'draft' ? 'text-danger' : 'text-success' }}">
                                        {{ ['draft' => 'Draf', 'published' => 'Dipublikasikan'][$course->status] ?? '-' }}
                                    </td>
                                    <td>Rp. {{ number_format($course->price, 0, ',', '.') }}</td>
                                    <td class="d-flex" style="gap: 1rem">
                                        <a href="{{ route('admin.chapter', $course->slug) }}" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.course.delete', $course->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin hapus kursus ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
