<?php
namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Http\Traits\SmsTrait;
use App\Mail\ContactMail;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use SmsTrait;
    public function contact()
       {
        return view('contact');
       }
       public function addData(ContactRequest $request)
       {
          $this->send($request->phone , $request->message);
        //  dd($request);
          $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
         Mail::to('asfan796@gmail.com')->send(new ContactMail( $details ));
         if ($request->post('id') > 0) {
            $contact = Contact::find($request->post('contact'));
        } else {
           $contact= new Contact;
           $contact->name=$request->name;
           $contact->email=$request->email;
           $contact->phone=$request->phone;
           $contact->subject=$request->subject;
           $contact->message=$request->message;
           $contact->save();
           if($contact)
           return back()->with('message_sent' , 'Your Message Has Been Sent Successfully');
        }
    }
     public function sendEmail(ContactRequest $request)
      {
            $response =  $this->addData($request);
            //   $response =  $this->SmsTrait($request);
                  $details = [
                      'name' => $request->name,
                      'email' => $request->email,
                      'phone' => $request->phone,
                      'subject' => $request->subject,
                      'message' => $request->message,
                  ];
                  Mail :: to('asfan796@gmail.com')->send(new ContactMail( $details ));
                  return back()->with('message_sent' , 'Your Message Has Been Sent Successfully');
              }

            public function list()
            {
                $result['contact']=Contact::paginate(5);
                // $result = Contact::paginate(8);
                return view('list' , $result);
            }
            public function manage_list($contact='')
            {
               if ($contact > 0) {
                   $arr = Contact::where(['id' => $contact])->get();
                   $result['name'] = $arr['0']->name;
                   $result['email'] = $arr['0']->email;
                   $result['phone'] = $arr['0']->phone;
                   $result['subject'] = $arr['0']->subject;
                   $result['message'] = $arr['0']->message;
                   $result['id'] = $arr['0']->id;
               } else {
                   $result['name'] = '';
                   $result['email'] = '';
                   $result['phone'] = '';
                   $result['subject'] = '';
                   $result['message'] = '';
                   $result['id'] = '';
               }
               return view('list', $result);
           }
}
