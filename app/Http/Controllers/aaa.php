<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use App\Models\Department;

class UserController extends Controller
{
    public function index()
    {
        $usr=User::all();
        return view('index',['usr'=>$usr]);
    }

    public function search_user(Request $req)
    {
        $search_data=$req->search_data;
        
        $output = '';

        $name_search_results_cnt=User::where('name', 'like', '%' . $search_data . '%')->count();
        if($name_search_results_cnt!=0)
        {
            $name_search_results=User::where('name', 'like', '%' . $search_data . '%')->get();
            foreach ($name_search_results as $name_search_result)
            {

                $output .= '<div class="col-sm-6">
                            <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">'.$name_search_result->name.'</h5>
                            <p class="card-text">'.$name_search_result->UserDepartment->name.'</p>
                            <p class="card-text">'.$name_search_result->UserDesignation->name.'</p>            
                            </div>
                            </div>
                            </div>';
            }
        }
        else
        {
                $designation_search_results_cnt=Designation::where('name', 'like', '%' . $search_data . '%')->count();
                if($designation_search_results_cnt!=0)
                {
                $designation_search_results=Designation::where('name', 'like', '%' . $search_data . '%')->get();
                foreach ($designation_search_results as $designation_search_result)
                    {
                         $user_desigs=User::where('fk_designation',$designation_search_result->id)->get();
                         foreach ($user_desigs as $user_desig)
                            {
                                 $output .= '<div class="col-sm-6">
                                <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">'.$user_desig->name.'</h5>
                                <p class="card-text">'.$user_desig->UserDepartment->name.'</p>
                                <p class="card-text">'.$user_desig->UserDesignation->name.'</p>            
                                </div>
                                </div>
                                </div>';
                            }               
                    } 
                 }

                 else
                 {
                    $department_search_results_cnt=Department::where('name', 'like', '%' . $search_data . '%')->count();
                    if($department_search_results_cnt!=0)
                    {
                    $department_search_results=Department::where('name', 'like', '%' . $search_data . '%')->get();
                    foreach ($department_search_results as $department_search_result)
                        {
                             $user_depts=User::where('fk_department',$department_search_result->id)->get();
                             foreach ($user_depts as $user_dept)
                                {
                                     $output .= '<div class="col-sm-6">
                                    <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">'.$user_dept->name.'</h5>
                                    <p class="card-text">'.$user_dept->UserDepartment->name.'</p>
                                    <p class="card-text">'.$user_dept->UserDesignation->name.'</p>            
                                    </div>
                                    </div>
                                    </div>';
                                }               
                        }  
                 }
                 else
                 {
                    $output .= '<div class="col-sm-6">
                                    <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Not found !!!</h5>          
                                    </div>
                                    </div>
                                    </div>';
                 }
                } 
        }
        echo $output;
    }
    
}
