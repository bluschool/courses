<?php namespace Bluschool\Courses\Http\Controllers;


use Bluschool\Courses\Http\Requests\CoursesRequest;
use Bluschool\Courses\Model\Courses;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;

class CoursesController extends AdminController {

    public function __construct()
    {
//        $this->middleware('registration');
        $this->middleware('courses');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Courses $courses)
	{
        return view('bluschool/courses::courses', compact('courses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('bluschool/courses::edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CoursesRequest $request )
	{
        try {
            $file = Input::file('file1');
            $filename1 = 'courses_'.uniqid() . '.jpg';
            $destinationPath = 'images/courses';
            $itemImage = Image::make($file)->fit(350, 450);
            $itemImage->save($destinationPath . '/' . $filename1);
            $request['photo'] = $destinationPath.'/'.$filename1;

            $courses = Courses::create($request->all());

        } catch (Exception $e) {
            Flash::error('Unable to Save');
            return $this->redirect(handles('bluschool/courses::courses'));
        }
        Flash::success($courses->name.' Saved Successfully');
        return $this->redirect(handles('bluschool/courses::member'));

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
