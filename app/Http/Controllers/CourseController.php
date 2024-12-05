<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')->get();
        return view('admin.courses.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $newCourse = Course::create($validated);

            DB::commit();

            return redirect()->route('dashboard.courses.index');
        } catch (\Exception $e) {
            Db::rollBack();
            $error = ValidationException::withMessages([
                'system_errpr' => ['System Error!', $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', [
            'course' => $course,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|string',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $course->update($validated);

            DB::commit();

            return redirect()->route('dashboard.courses.index');
        } catch (\Exception $e) {
            Db::rollBack();
            $error = ValidationException::withMessages([
                'system_errpr' => ['System Error!', $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('dashboard.courses.index');
        } catch (\Exception $e) {
            Db::rollBack();
            $error = ValidationException::withMessages([
                'system_errpr' => ['System Error!', $e->getMessage()]
            ]);
            throw $error;
        }
    }
}
