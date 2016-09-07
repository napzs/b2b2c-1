<?php

use yii\helpers\Console;
use yii\db\Migration;

class m190908_053628_init_admin extends Migration {
    public function up() {
        $this->createFounder();
    }

    public function down() {
        echo "m190908_053628_init_admin cannot be reverted.\n";

        return false;
    }

    /**
     * 创建创始人数据
     */
    public function createFounder() {
        Console::output("\n创建系统管理员:   ");

        $user = $this->saveFounderData(new \frontend\models\SignupForm());

        $user ? $user->id : 1; // 用户创建成功则指定用户id,否则指定id为1的用户为创始人.

        Console::output("系统管理员创建" . ($user ? '成功' : "失败，请手动创建系统管理员\n"));
    }

    /**
     * 用户创建交互
     *
     * @param $_model
     * @return mixed
     */
    private function saveFounderData($_model) {
        /** @var \frontend\models\SignupForm $model */
        $model = clone $_model;
        $model->username = Console::prompt('请输入管理员用户名', ['default' => 'admin']);
        $model->email = Console::prompt('请输入管理员邮箱', ['default' => 'i@b2b2c.com']);
        $model->password = Console::prompt('请输入管理员密码', ['default' => 'password']);
        $model->role = \common\models\User::ROLE_SUPER_ADMIN;

        if (!($user = $model->signup())) {
            Console::output(Console::ansiFormat("\n输入数据验证错误:", [Console::FG_RED]));
            foreach ($model->getErrors() as $k => $v) {
                Console::output(Console::ansiFormat(implode("\n", $v), [Console::FG_RED]));
            }
            if (Console::confirm("\n是否重新创建系统管理员:")) {
                $user = $this->saveFounderData($_model);
            }
        }

        return $user;
    }
}
