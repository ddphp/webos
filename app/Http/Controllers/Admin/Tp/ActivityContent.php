<?php
namespace App\Http\Controllers\Admin\Tp;

use App\Models\Voting\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityContent extends Controller
{
    public function edit(Request $request, $activity)
    {
        $_crumb = ['name' => '活动详情', 'act' => ''];

        $activity = Activity::findOrFail($activity);
        $content  = $activity->activityContent;

        return view('admin.tp.index.content', compact('activity', 'content', '_crumb'));
    }

    public function store(Request $request, $activity)
    {
        $content = \App\Models\Voting\ActivityContent::where('activity_id', $activity)->first();

        $detail = trim($request->detail);
        if ($detail === $content->detail) {
            return '数据未变更';
        }
        $content->detail = $detail;

        $content->save();

        return '保存成功';
    }
}
