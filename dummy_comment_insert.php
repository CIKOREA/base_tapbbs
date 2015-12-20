<?php
$con = mysqli_connect('localhost', 'root', 'qwe123');
mysqli_select_db($con, 'cikorea');

$arr = array(
    '대통령은 내우·외환·천재·지변 또는 중',
    '대법관은 대법원장의 제청으로 국회의 동의',
    '형사피해자는 법률이 정하는 바에 의하여',
    '지방의회의 조직·권한·의원선거와 지방자',
    '환경권의 내용과 행사에 관하여는 법률로',
    '제1항의 탄핵소추는 국회재적의원 3분의 1',
    '감사위원은 원장의 제청으로 대통령이 임명',
    '국교는 인정되지 아니하며, 종교와 정치는',
    '국회는 국정을 감사하거나 특정한 국정사안',
    '국군은 국가의 안전보장과 국토방위의 신성',
    '군인은 현역을 면한 후가 아니면 국무총리',
    '국민의 모든 자유와 권리는 국가안전보장',
    '제2항과 제3항의 처분에 대하여는 법원에',
    '모든 국민은 법률이 정하는 바에 의하여 납',
    '국군의 조직과 편성은 법률로 정한다. 대통',
    '모든 국민은 능력에 따라 균등하게 교육을',
    '모든 국민은 법률이 정하는 바에 의하여 국',
    '대한민국의 주권은 국민에게 있고, 모든 권',
    '국회는 정부의 동의없이 정부가 제출한 지',
    '모든 국민은 근로의 의무를 진다. 국가는'
);

$sql = "SELECT idx, bbs_idx FROM tb_bbs_article WHERE bbs_idx = 1 ORDER BY bbs_idx, idx ASC";
$res = mysqli_query($con, $sql);

$count = 0;
while ($count < 50) {

    while ($row = mysqli_fetch_assoc($res)) {

        $key     = mt_rand(0, 19);

        if ($key < 3) {
            continue;
        }

        $comment = $arr[$key];

        $sql = "
            INSERT INTO tb_bbs_comment
                (bbs_idx, article_idx, user_idx, exec_user_idx, comment, timestamp_insert, client_ip_insert, is_deleted, agent_insert)
            VALUES (
                " . $row['bbs_idx'] . ",
                " . $row['idx'] . ",
                '1',
                '1',
                '" . $comment . "',
                " . time() . ",
                '127.0.0.1',
                'F',
                'P'
            );
        ";
        mysqli_query($con, $sql);
    }

    $count++;
}

$sql = "SELECT idx, bbs_idx FROM tb_bbs_article ORDER BY bbs_idx, idx ASC";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($res)) {

    $sql = "SELECT COUNT(*) AS count FROM tb_bbs_comment WHERE bbs_idx = " . $row['bbs_idx'] . " AND article_idx = " . $row['idx'];
    $res1 = mysqli_query($con, $sql);
    $row1 = mysqli_fetch_assoc($res1);

    $up = "UPDATE tb_bbs_article SET comment_count = " . $row1['count'] . " WHERE idx = " . $row['idx'];

    $a = mysqli_query($con, $up);
    var_dump($a);
}
mysqli_close($con);
