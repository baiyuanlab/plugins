<?php
/*
Plugin Name: Disk Space Stats
Description: Display server disk space statistics in the admin menu.
Version: 1.0
*/

// 添加外掛選單項目
function add_disk_space_stats_menu() {
    add_menu_page(
        'Disk Space Stats',
        'Disk Space',
        'manage_options',
        'disk-space-stats',
        'display_disk_space_stats'
    );
}

// 顯示硬碟可用空間統計資訊
function display_disk_space_stats() {
    echo '<div class="wrap">';
    echo '<h2>Disk Space Statistics</h2>';
    echo '<p>Here are the server disk space statistics:</p>';
    
    // 呼叫硬碟空間計算函數
    get_server_disk_space();
    
    echo '</div>';
}

// 計算硬碟可用空間
function get_server_disk_space() {
    $total_space = disk_total_space(__DIR__); // 硬碟總空間
    $free_space = disk_free_space(__DIR__);   // 硬碟可用空間
    
    if ($total_space !== false && $free_space !== false) {
        $total_space_gb = round($total_space / (1024 * 1024 * 1024), 2);
        $free_space_gb = round($free_space / (1024 * 1024 * 1024), 2);
        
        echo "總硬碟空間：{$total_space_gb} GB<br>";
        echo "可用硬碟空間：{$free_space_gb} GB<br>";
    } else {
        echo "無法取得硬碟空間資訊。";
    }
}

add_action('admin_menu', 'add_disk_space_stats_menu');
?>
