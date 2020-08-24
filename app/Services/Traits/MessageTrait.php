<?php

namespace App\Services\Traits;

use App\Models\Message;
use App\Models\MessageRecipient;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait MessageTrait
{

    private $folderName = 'messages/';

    /**
     * @param $select
     * @param $messageId
     */

    private function saveMessageRec($select, $messageId)
    {
        foreach ($select as $item){

            $messRec = new MessageRecipient(['message_id' => $messageId]);
            $tableNameId = explode("-", $item);

            if($tableNameId[0] == 'student'){
                $person = Student::find($tableNameId[1]);
            } else {
                $person = Teacher::find($tableNameId[1]);
            }

            $person->messageRecipients()->save($messRec);
        }

    }

    /**
     * @param $fileName
     * @param $text
     */
    private function createHtmlFileSaveText($fileName, $text)
    {
        if(Storage::exists($this->folderName)){
            Storage::put($this->folderName.'/'.$fileName, $text);

        } else{
            Storage::makeDirectory($this->folderName);
            Storage::put($this->folderName.'/'.$fileName, $text);
        }
    }

    /**
     * @return string
     */
    private function fileName()
    {
        return 'body-' . md5(time()) .'.html';
    }

    /**
     * @param $body
     * @return string
     */
    private function fullPathToHtmlFile($body){
        return storage_path('app/'.$body);
    }

    /**
     * @param $arr
     * @return array
     */
    private function splitString($arr)
    {
        $oldSelect = [];
        foreach ($arr as $item){
            $splitString = explode("\\", $item->mes_rec_type);
            $oldSelect[] = strtolower($splitString[2]) .'-'. $item->mes_rec_id;
        }

        return $oldSelect;
    }

}
