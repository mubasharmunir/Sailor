<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{

}
// <?php

// namespace App\Http\Controllers;
// use App\Http\Requests\ContactRequest;
// use App\Mail\ContactMail;
// use App\Models\Contact;
// use Illuminate\Support\Facades\Request;
// use Mail;

// class ContactController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function contact()
//     {

//         return view('contact');
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function sendEmail(ContactRequest $request)
//     {
//         {
//         $details = [
//             'name' => $request->name,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'subject' => $request->subject,
//             'message' => $request->message,
//         ];

//         Mail :: to('asfan796@gmail.com')->send(new ContactMail( $details ));
//         return back()->with('message_sent' , 'Your Message Has Been Sent Successfully');
//     }

//     // public function manage_contact_process(ContactRequest $request)

//     //     $request->session()->flash('message', 'cetagory inserted');
//     //     return redirect('contact');
//     // }

//    }


// }
