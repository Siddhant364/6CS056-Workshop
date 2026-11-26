<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display courses.
     * Admin sees all courses.
     * Regular users see only their own courses.
     */
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {

            $courses = Course::latest()->get();

        } else {

            $courses = $request->user()
                ->courses()
                ->latest()
                ->get();
        }

        return view('course.index', compact('courses'));
    }

    /**
     * Display the course creation form.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        // Automatically assign the logged-in user's ID
        $course = $request->user()
            ->courses()
            ->create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', "Course {$course->name} created successfully!");
    }

    /**
     * Display a specific course.
     */
    public function show(Course $course)
    {
        Gate::authorize('manage-course', $course);

        return view('course.detail', ['course' => $course]);
    }

    /**
     * Display the course editing form.
     */
    public function edit(Course $course)
    {
        Gate::authorize('manage-course', $course);

        return view('course.edit', ['course' => $course]);
    }

    /**
     * Update a specific course.
     */
    public function update(Request $request, Course $course)
    {
        Gate::authorize('manage-course', $course);

        $course->update(
            $request->validate($this->rules())
        );

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Delete a specific course.
     */
    public function destroy(Course $course)
    {
        Gate::authorize('manage-course', $course);

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    /**
     * Course validation rules.
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'difficulty' => [
                'required',
                Rule::in(['Easy', 'Medium', 'Hard']),
            ],
            'is_active' => 'required|boolean',
        ];
    }
}
