<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\DataTables\Facades\DataTables;
use App\Libraries\Filterable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getDataAjax($request)
    {
        if($request->ajax()) {
            $data = $this->filter($request)->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.elements.action', [
                        'model' => $data,
                        'title' => 'New',
                        'url_show' => null,
                        'url_edit' => route('home.edit', $data->id),
                        'url_destroy' => route('home.destroy', $data->id)
                    ]);
                })
                ->editColumn('created_at', function($data){
                    // return Carbon::createFromFormat('Y-m-d h:m:s', $data->created_at)->format('Y-m-d');
                    return $data->created_at->format('Y-m-d');
                })
                ->rawColumns(['action', 'name', 'created_at'])
                ->make(true);
        }
    }
}
