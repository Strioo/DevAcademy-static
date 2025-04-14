<?php

namespace App\Http\Controllers\Member\Courses;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;


class MemberCourseController extends Controller
{
    public function index(Request $request)
    {
        // filter kelas menggunakan checkbox category
        $categoryFilter = $request->input('filter-kelas');

        $category = Category::all();

        // mengambil data course khusus publik
        $courses = Course::where('status', 'published')->with('users')->get();

        // mengambil course dari category filter
        if ($categoryFilter && $categoryFilter != 'semua') {
            $courses = Course::where('status', 'published')->where('category', $categoryFilter)->with('users')->get();
        }

        return view('member.courses.course', compact('courses', 'category'));
    }

    public function join($slug)
    {
        $courses = Course::where('slug', $slug)->first();
        // $reviews = Review::where('course_id', $course->id)->get();

        if ($courses) {
            $chapters = Chapter::with('lessons')
                ->where('course_id', $courses->id)
                ->get();
            $coursetools = Course::with('tools')->findOrFail($courses->id);

            if ($chapters->isNotEmpty()) {
                $lesson = Lesson::with('chapters')
                    ->where('chapter_id', $chapters->first()->id)
                    ->first();
            } else {
                $lesson = null;
            }

            if (Auth::user()) {
                $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('course_id', $courses->id)
                    ->first();
            } else {
                $transaction = null;
            }


            // Mengambil data reviews yang cocok dengan course
            $reviews = Review::with('user')->where('course_id', $courses->id)->get();

            return view('member.courses.join-course', compact('chapters', 'courses', 'lesson', 'transaction', 'coursetools', 'reviews'));
        } else {
            // Jika kursus tidak ditemukan, redirect ke halaman error
            return redirect()->route('pages.error');
        }
    }

    public function play($slug, $episode)
    {
        // Mengambil data kursus berdasarkan slug
        $courses = Course::where('slug', $slug)->first();
        // Mengambil data mentor berdasarkan mentor_id dari kursus
        // $user = User::where('id', $courses->mentor_id)->first();

        // Mengambil semua chapter dan lesson terkait kursus
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();

        // Mengambil data lesson berdasarkan episode
        $play = Lesson::where('slug_episode', $episode)->first();

        // Memeriksa apakah user yang login telah melakukan transaksi untuk kursus ini
        $checkTrx = Transaction::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Memeriksa apakah user sudah memberikan review untuk kursus ini
        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        // Memeriksa apakah episode yang sedang diputar sudah ditandai sebagai selesai
        $checkCompelete = CompleteEpisodeCourse::where('episode_id', $play->id)
            ->where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Jika episode belum ditandai selesai, maka buat data baru di tabel CompleteEpisodeCourse
        if (!$checkCompelete) {
            CompleteEpisodeCourse::create([
                'user_id' => Auth::user()->id,
                'course_id' =>  $courses->id,
                'episode_id' => $play->id
            ]);
        }

        // Mendapatkan daftar episode yang telah selesai untuk user ini di kursus terkait
        $epComplete = CompleteEpisodeCourse::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->pluck('episode_id') // Hanya mengambil ID episode yang selesai
            ->toArray();

        // Memeriksa apakah user memiliki transaksi untuk kursus ini
        if ($checkTrx) {
            // Jika transaksi ditemukan, tampilkan halaman play dengan data terkait
            return view('member.courses.play', compact('play', 'chapters', 'slug', 'courses', 'checkReview', 'epComplete'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan kembali ke halaman join
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.courses.join', $slug);
        }
    }

    public function detail($slug)
    {
        // Mengambil data course berdasarkan slug yang diberikan
        $courses = Course::where('slug', $slug)->first();
        // Mengambil semua review untuk course, termasuk data user yang memberikan review
        $reviews = Review::with('user')->where('course_id', $courses->id)->get();
        // Mengambil data mentor (user) yang terkait dengan course
        $user = User::where('id', $courses->mentor_id)->first();
        // Mengambil semua chapter yang terkait dengan course, termasuk data lessons di dalamnya
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        // Memeriksa apakah user yang sedang login sudah membeli course ini
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        // Memeriksa apakah user yang sedang login sudah memberikan review untuk course ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->first();
        // Mengambil semua tools yang terkait dengan course
        $coursetools = Course::with('tools')->findOrFail($courses->id);
        // Mengambil data episode yang telah diselesaikan oleh user dalam course ini
        $compeleteEps = CompleteEpisodeCourse::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->get();
        // Menghitung total jumlah lesson di semua chapter
        $totalLesson = 0;
        foreach ($chapters as $chapter) {
            $totalLesson += $chapter->lessons->count();
        }

        // Memeriksa apakah user telah menyelesaikan semua episode dalam course
        $checkSertifikat = false;
        if ($totalLesson == $compeleteEps->count()) {
            $checkSertifikat = true; // Sertifikat dapat diberikan
        }

        return redirect()->back();
    }

    public function generateSertifikat($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $checkCourse = MyListCourse::where('course_id', $course->id);
        if ($checkCourse) {

            // Data dinamis
            $data = [
                'name' => Auth::user()->name,
                'course' =>  $course->category . ' : ' . $course->name,
                'date' => \Carbon\Carbon::now()->format('d F Y')
            ];

            $pdf = Pdf::loadView('sertifikat.view', $data)->setPaper('A4', 'landscape');

            return $pdf->download('sertifikat-' . Auth::user()->name . '.pdf');
        }
        return redirect()->back();
    }
}
