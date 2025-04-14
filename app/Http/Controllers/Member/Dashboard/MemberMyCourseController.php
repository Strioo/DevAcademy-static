<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Course;
use App\Models\Ebook;
use App\Models\Transaction;
use App\Models\Submission;
use App\Models\MyListCourse;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;

class MemberMyCourseController extends Controller
{
    public function index(Request $request) {
        $filter = $request->input('filter');
        $lists = MyListCourse::where('user_id', Auth::user()->id)->get();
        $courseIds = $lists->pluck('course_id');

        $coursesQuery = Course::whereIn('id', $courseIds)->orderBy('id', 'DESC');

        switch ($filter) {
            case 'kursus':
                $courses = $coursesQuery->get();
                break;
            default:
                $courses = $coursesQuery->get();
                break;
        }
        $coursesProgress = $courses->map(function ($course) {
            $totalLessons = Chapter::where('course_id', $course->id)
                ->withCount('lessons')
                ->get()
                ->sum('lessons_count');
            $lessonProgress = CompleteEpisodeCourse::where('user_id', Auth::user()->id)
                ->where('course_id', $course->id)
                ->count();
            $course->total_lesson = $totalLessons;
            $course->lesson_progress = $lessonProgress;
            $course->status = ($lessonProgress == $totalLessons) ? 'Selesai' : 'Belum Selesai';

            return $course;
        });

        $total_course = Transaction::where('user_id', Auth::user()->id)
                                    ->where('status', 'success')
                                    ->count();

        return view('member.dashboard.mycourse.view', compact('coursesProgress', 'total_course'));
    }


}
