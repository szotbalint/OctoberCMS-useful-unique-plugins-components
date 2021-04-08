<?php namespace yourNameSpace\yourPluginName\components;

use Cms\Classes\ComponentBase;
use Input;
use yourNameSpace\yourPluginName\Models\yourModelName;

class yourModelName extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'yourComponentName',
            'description' => 'yourComponentDescription'
        ];
    }


    public function onRun()
    {
        $this->filteredItems = $this->filterFunction();
    }

    protected function filterFunction()
    {
        $search = Input::get('search');
        $query = yourModelName::all();


        /*if ($search) {
            $query =  yourModelName::where('fooColumnName', 'like', "%${query}%")->orWhere('otherColumName', 'like', "%${query}%")->get();
        }*/
        if($search) {
            $query = yourModelName::where('fooColumnName', 'like', "%${search}%")->get();
            return $query;
        }
        
        return null;
    }

    public $filteredItems;

}
