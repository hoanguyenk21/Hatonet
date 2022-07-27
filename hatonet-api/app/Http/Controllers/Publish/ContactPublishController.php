<?php

namespace App\Http\Controllers\Publish;
use App\Models\MailRegister;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer_reviews;
class ContactPublishController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = $request->only('name', 'email', 'phone', 'message');
        $result = Customer_reviews::create($data);
        $result = \Mail::send('mail', ['data' => $data], function ($message) use ($data) {
        $message->to('hoant2001a@gmail.com');
        $message->subject($data['name']. ' đã gửi cho bạn 1 phản hồi!');
    });
    return response()->json(['message' =>$result ],200);
    }
    public function sendMailRegister(Request $request)
    {
        $data = new MailRegister([
            'email' => $request->email,
        ]);
        $data->save();
        $result = \Mail::send('mailadmin', ['data' => $data], function ($message) use ($data) {
            $message->to('hoant2001a@gmail.com');
            $message->subject($data['email'] . ' đã gửi cho bạn 1 đăng ký tin!');
        });
        $result = \Mail::send('mailuser', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('[HATONET] ' . 'Thông báo mới!');
        });
        return response()->json(['message' =>$result ],200);
    }
}
