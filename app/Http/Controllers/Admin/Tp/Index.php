<?php

namespace App\Http\Controllers\Admin\Tp;

use App\Contracts\Voting\ManageImages;
use App\Models\Voting\Activity;
use App\Models\Voting\ActivityCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    public function index()
    {
        $urls = app(\stdClass::class);
        $urls->edit = route('admin.tp.edit');
        return view('admin.tp.index.index', compact('urls'));
    }

    public function query(Request $request)
    {
        $page = $request->input('page', 1);
        $name = $request->input('name', '');
        $date = $request->input('date', '');
        $take = 10;


        $activity = Activity::skip($take*($page-1))->take($take);
        if ($name) {
            $activity = $activity->where('name', 'like', "%{$name}%");
        }
        if ($date) {
            $activity = $activity->where([
                ['sdate', '<=', $date],
                ['edate', '>=', $date]
            ]);
        }

        $ret['list'] = $activity->orderBy('id', 'desc')->select(['id','name','sdate','edate','type'])->get();
        $ret['page'] = [
            'cur' => $page,
            'max' => ceil(Activity::count()/$take)
        ];

        return $ret;
    }

    public function edit($activity = -1)
    {
        $_crumb = ['name' => $activity === -1 ? '新建活动' : '编辑活动', 'act' => ''];
        $fields = ['id','name','banner','sdate','edate','type','tot','num','vote','skin'];
        $form   = array_combine($fields, [null,'','','','',0,1,1,1,'default']);

        if ($activity !== -1) {
            $form = Activity::select($fields)->findOrFail($activity);
        }

        return view('admin.tp.index.save', compact('_crumb', 'form'));
    }

    public function save(Request $request, ManageImages $images, $activity = null)
    {
        $imageFile = $request->file('image', null);
        $fields = ['name','banner','sdate','edate','type','tot','num','vote','skin'];
        $data = $request->only($fields);
        if ($imageFile) {
            $image = $images->saveImage($imageFile);
            $data['banner'] = $images->getImageUrl($image);
        }

        if ($activity) {
            $Activity = Activity::findOrFail($activity);
        } else {
            $Activity = new Activity();
        }
        foreach ($data as $key => $value) {
            $Activity->$key = $value;
        }
        $Activity->save();

        $content = $Activity->activityContent;
        if (!$content) {
            $content = app(\App\Models\Voting\ActivityContent::class);
            $content->activity_id = $Activity->id;
            $content->desc = '';
            $content->detail = '';
            $content->ext = '';
            $content->save();
        }

        $count = $Activity->activityCount;
        if (!$count) {
            $count = app(ActivityCount::class);
            $count->activity_id = $Activity->id;
            $count->save();
        }

        $ret = $Activity->toArray();
        foreach ($Activity as $key => $value) {
            if (!in_array($key, $fields)) {
                unset($ret[$key]);
            }
        }
        return $ret;
    }
}
