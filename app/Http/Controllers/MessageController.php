<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Services\Traits\MessageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use App\Services\Traits\ModelTrait;

class MessageController extends Controller
{

    use ModelTrait;
    use MessageTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = Message::all();

        return view('messages.index', ['messages' => $messages]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $select = [];
        $select['Students'] = $this->getDataFromModelByMap(Student::all(), 'student');
        $select['Teachers'] = $this->getDataFromModelByMap(Teacher::all(), 'teacher');

        return view('messages.one', [
            'message' => new Message,
            'select' => $select,
            'oldSelect' => []
        ]);
    }

    /**
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageRequest $request)
    {
        $name =  $this->fileName();

        $this->createHtmlFileSaveText($name, $request->body);
        $message = Message::create(['subject'=> $request->subject, 'body'=> $this->folderName . $name]);
        $this->saveMessageRec($request->select, $message->id);

        session()->flash('success',  'Message has been created.');

        return redirect()->route('messages.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $message = Message::find($id);
        $select = [];
        $message->body = File::get($this->fullPathToHtmlFile($message->body));
        $oldSelect = $this->splitString($message->messageRecipients);
        $select['Students'] = $this->getDataFromModelByMap(Student::all(), 'student');
        $select['Teachers'] = $this->getDataFromModelByMap(Teacher::all(), 'teacher');

        return view('messages.one', [
            'message' => $message,
            'select' => $select,
            'oldSelect' => $oldSelect
        ]);
    }

    /**
     * @param MessageRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MessageRequest $request, $id)
    {
        $message = Message::find($id);
        $name =  $this->fileName();

        $this->createHtmlFileSaveText($name, $request->body);
        \Storage::delete($message->body);

        $path = storage_path('app/'.$this->folderName. '/'.$name);
        $message->update(['subject'=> $request->subject, 'body'=> $path]);
        $this->saveMessageRec($request->select, $id);


        session()->flash('success',  'Message has been updated.');

        return redirect()->route('messages.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        \Storage::delete($message->body);
        $message->delete();

        session()->flash('success',  'Message has been deleted.');

        return redirect()->route('messages.index');
    }
}
