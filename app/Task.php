<?php

namespace App;

use App\Todo;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['description', 'deadline', 'disabled', 'completed'];
    
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }

    public function complete($completed = true)
    {     
        if($this->canComplete()) {
            $this->update(compact('completed'));
        }  
    }

    public function incomplete() {
       $this->update(['completed' => false]);
    }

    public function expired() {
        if(!is_null($this->deadline)) {
            return $this->deadline < now();
        }
        return false;
    }

    protected function canComplete() {
        if($this->expired()) {
            throw new Exception('You cannot complete an expired task');
        } else if($this->disabled) {
            throw new Exception('You cannot complete a disabled task');
        } else if($this->completed) {
            throw new Exception('This task is already complete');
        }

        return true;
    }
    
}
