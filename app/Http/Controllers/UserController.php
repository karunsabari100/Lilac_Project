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
        $usr=User::all();
        
        $output = '';   
        if($search_data=='')
        {
            $users_lists = User::all(); 
            foreach ($users_lists as $users_list)
                     {
        
                        $output .= '<div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">'.$users_list->name.'</h5>
                        <p class="card-text">'.$users_list->UserDesignation->name.'</p> 
                        <p class="card-text">'.$users_list->UserDepartment->name.'</p>    
                        </div>
                        </div>
                        </div>';
                     } 
        }
        else
        {
            $name_search_results_cnt=User::where('name', 'like', '%' . $search_data . '%')->count(); 
            $designation_search_results_cnt=Designation::where('name', 'like', '%' . $search_data . '%')->count();
            $department_search_results_cnt=Department::where('name', 'like', '%' . $search_data . '%')->count();

            if($name_search_results_cnt==0 &&  $designation_search_results_cnt==0 && $department_search_results_cnt==0)
            {
                $output .= '<div class="col-sm-6">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title">Not Found !!</h5>
                </div>
                </div>
                </div>';
            }
            else
            {

                    $query = User::select('*');  
                    if ($name_search_results_cnt!=0) {
                     $query->where('name', 'like', '%' . $search_data . '%');
                    }
                    $designation_search_results=Designation::where('name', 'like', '%' . $search_data . '%')->get();
                    if ($designation_search_results_cnt!=0) {
                    foreach ($designation_search_results as $designation_search_result)
                        {
                            $query->orWhere('fk_designation',$designation_search_result->id);      
                        } 
                    }

                    $department_search_results=Department::where('name', 'like', '%' . $search_data . '%')->get();
                    if ($department_search_results_cnt!=0) {
                    foreach ($department_search_results as $department_search_result)
                        {
                             $query->orWhere('fk_department',$department_search_result->id);      
                        } 
                    }

                     $users_lists=$query->get();  
                    foreach ($users_lists as $users_list)
                     {
        
                        $output .= '<div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">'.$users_list->name.'</h5>
                        <p class="card-text">'.$users_list->UserDesignation->name.'</p> 
                        <p class="card-text">'.$users_list->UserDepartment->name.'</p>    
                        </div>
                        </div>
                        </div>';
                     }
                
            }
        }
        echo $output;
           
        }
        
    }
    

