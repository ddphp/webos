<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Admin\Tools\ProfileTrait;
use App\Http\Requests\Admin\Company;
use App\Models\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyConfig extends Controller
{
    public function index(Request $request)
    {
        $companyConfig = Config::find('member.company');
        if ($companyConfig && $companyConfig->value) {
            $form = $companyConfig->value;
        } else {
            $form = $this->fillFields(['name', 'store', 'logo', 'axis', 'address', 'tel']);
        }

        return view('admin.member.company', compact('form'));
    }

    public function store(Company $company)
    {
        $companyModel = Config::find('member.company');
        if (!$companyModel) {
            $companyModel = new Config();
            $companyModel->name = 'member.company';
        }

        $value = json_encode($company->input());

        if ($companyModel->value === $value) {
            return '没有数据变更';
        }

        $companyModel->value = $value;

        if ($companyModel->save()) {
            return '保存成功';
        } else {
            return '保存失败';
        }
    }

    private function fillFields(array $fields)
    {
        return json_encode(array_combine($fields, array_fill(0, count($fields), '')));
    }
}
