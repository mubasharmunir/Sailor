<?php
namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class FormController extends Controller
{
    public function form(Request $request){
        return view('form');
    }
    public function formSubmit(Request $request){
            //    dd($request->all());
                $model=new Form();
                $model->name=$request->name;
                $model->email=$request->email;
                $model->cars=$request->cars;
                $model->birthday=$request->birthday;
                if ($request->hasFile('image')) {
                    $file=$request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename= time().'.'.$extension;
                    $file->move('uploads/' , $filename);
                    $model->image = $filename;
                }
                $model->save();
                return response()->json([
                    'status'=> true,
                    'message' => 'Success',
                    "result"=>"Data Inserted"
                ]);
           }
           public function jquery()
           {
               $result['form']=Form::paginate(5);
               return view('jquerylist' , $result);
           }
           public function manage_jquerylist($form='')
           {
              if ($form > 0) {
                  $arr = Form::where(['id' => $form])->get();
                  $result['name'] = $arr['0']->name;
                  $result['email'] = $arr['0']->email;
                  $result['cars'] = $arr['0']->cars;
                  $result['birthday'] = $arr['0']->birthday;
                  $result['image'] = $arr['0']->image;
                  $result['id'] = $arr['0']->id;
              } else {
                  $result['name'] = '';
                  $result['email'] = '';
                  $result['cars'] = '';
                  $result['birthday'] = '';
                  $result['image'] = '';
                  $result['id'] = '';
              }
              return view('', $result);
          }

          public function edit($id)

           {
              $model=Form::find($id);
              return view('edit-form' , compact('model'));
           }

           public function update(Request $request, $id)

           {
            // dd($request->all());
             $model=Form::find($id);
             $model->name=$request->name;
             $model->email=$request->email;
             $model->cars=$request->cars;
             $model->birthday=$request->birthday;
             if ($request->hasFile('image')) {
                 $destination= 'uploads/'.$model->image;
                 if(File::exists($destination))
                  {
                    File::delete($destination);
                  }
                 $file=$request->file('image');
                 $extension = $file->getClientOriginalExtension();
                 $filename= time().'.'.$extension;
                 $file->move('uploads/' , $filename);
                 $model->image = $filename;
             }
             $model->update();
              return redirect('jquerylist')->with('status','Data Updated Successfully');
           }

           public function delete($id)
           {
               $model=Form::findorfail($id);
               $model->delete();
               return response()->json(['status','Data Updated Successfully']);
           }

}
