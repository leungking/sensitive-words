<?php

namespace Hooey\SensitiveWords;

/**
 * Username sensitive-word list with substring matching.
 *
 * Matching ignores case and common separators, mirroring the legacy
 * forum's registration filter. Only the word list is ported here.
 */
class SensitiveWords
{
    /** @var string[] */
    public static array $words = [
        '管理员', 'admin', 'administrator', '版主', 'moderator', 'mod', '系统', 'system', '官方', 'official', '客服', '站长', 'webmaster', 'root', '超级管理员', 'superadmin', '论坛管理', 'bbs管理', '社区管理', '物业', '管家', '业委会',
        '法轮功', 'falungong', '六四', '64', '天安门', 'tiananmen', '藏独', '疆独', '台独', '港独', '达赖', 'dalai', '江泽民', '胡锦涛', '习近平', '李克强', '温家宝', '朱镕基', '邓小平', '毛泽东', '共产党', '共匪', '支那', 'china', '8964', '八九', '民运', '民主运动', '反共', '反党', '颠覆', '煽动', '游行', '示威', '暴动', '镇压', '屠杀', '专制', '独裁', '极权', '人权', '自由民主', '普选', '双普选', '占中', '雨伞', '反送中', '光复', '黑警', 'gcd', 'zf', '政府',
        '操你', '草你', 'cao你', '肏', '婊子', 'biaozi', '傻逼', 'shabi', 'sb', '煞笔', '智障', '脑残', 'naocan', '死妈', 'nmsl', 'nmslese', '妈卖批', 'mmp', '狗日', 'gouri', '杂种', 'zazhong', '贱人', 'jianren', '贱货', '婊', '妓女', 'jinv', '鸡婆', '王八蛋', '龟孙', '畜生', 'chusheng', '垃圾', 'laji', '废物', 'feiwu', '白痴', 'baichi', '二逼', 'erbi', '吊', 'diao', '屌', '鸡巴', 'jiba', '阴茎', 'yinjing', '阴道', 'yindao', '乳房', 'rufang', '做爱', 'zuoai', '性交', 'xingjiao', '强奸', 'qiangjian', '轮奸', '口交', 'koujiao', '肛交', '自慰', 'ziwei', '手淫', 'shouyin', '精液', 'jingye', '月经', 'yuejing', '大便', 'dabian', '小便', 'xiaobian', '放屁', 'fangpi',
        '赌博', 'dubo', '博彩', 'bocai', '赌场', 'duchang', '百家乐', 'baijiale', '老虎机', '六合彩', '时时彩', '贷款', 'daikuan', '借贷', 'jiedai', '套现', 'taoxian', '信用卡', '刷单', 'shuadan', '兼职', 'jianzhi', '赚钱', 'zhuanqian', '打字员', 'daziyuan', '色情', 'seqing', 'porn', 'av', 'a片', '三级片', '小姐', 'xiaojie', '援交', 'yuanjiao', '包养', 'baoyang', '一夜情', 'yiyeqing', '约炮', 'yuepao', '裸聊', 'luoliao', '发票', 'fapiao', '代开', 'daikai', '办证', 'banzheng', '刻章', 'kezhang', '文凭', 'wenping', '毕业证', '枪支', 'qiangzhi', '毒品', 'dupin', '冰毒', '海洛因', '摇头丸', '迷药', 'miyao', '窃听', 'qieting', '黑客', 'heike', '破解', 'pojie', '外挂', 'waigua', '代练', 'dailian', '私服', 'sifu', '棋牌', 'qipai', '捕鱼', 'buyu', '微信', 'weixin', 'wx', 'qq', '加我', 'jiawo', '联系', 'lianxi', '电话', 'dianhua', '手机', 'shouji',
        'test', '测试', 'ceshi', 'guest', '游客', 'youke', '匿名', 'niming', 'null', 'undefined', 'delete', 'deleted',
    ];

    public static function contains(string $username): bool
    {
        $hay = self::normalize($username);

        if ($hay === '') {
            return false;
        }

        foreach (self::$words as $word) {
            $needle = self::normalize($word);

            if ($needle !== '' && mb_strpos($hay, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    private static function normalize(string $value): string
    {
        $value = mb_strtolower($value, 'UTF-8');

        return (string) preg_replace('/[\s\-_\.·•,;:\/\\\\]+/u', '', $value);
    }
}
