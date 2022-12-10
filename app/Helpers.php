<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function is_hidden($action)
{
    return is_able($action) ? '' : 'hidden';
}

function is_able($action)
{
    $role = [
        'Admin' => [
            'home',
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'master_menu',
            'jenis.index', 'jenis.create', 'jenis.store', 'jenis.edit', 'jenis.update', 'jenis.destroy', 'jenis.cetak',
            'kelas.index', 'kelas.create', 'kelas.store', 'kelas.edit', 'kelas.update', 'kelas.destroy', 'kelas.cetak',
            'siswa.index', 'siswa.create', 'siswa.store', 'siswa.edit', 'siswa.update', 'siswa.destroy', 'siswa.cetak',
            'event.index', 'event.create', 'event.store', 'event.edit', 'event.update', 'event.destroy', 'event.cetak',
            'guru.index', 'guru.create', 'guru.store', 'guru.edit', 'guru.update', 'guru.destroy', 'guru.cetak',
            'kompetensi.index', 'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 'kompetensi.cetak',
            'indikator.index', 'indikator.create', 'indikator.store', 'indikator.edit', 'indikator.update', 'indikator.destroy', 'indikator.cetak',
            'kompetensi.index', 'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 'kompetensi.cetak',
            'solusi.index', 'solusi.create', 'solusi.store', 'solusi.edit', 'solusi.update', 'solusi.destroy', 'solusi.cetak',
            'relasi.index', 'relasi.create', 'relasi.store', 'relasi.edit', 'relasi.update', 'relasi.destroy', 'relasi.cetak', 'relasi.aturan',
            'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak', 'histori.detail', 'histori.destroy',
        ],
         'AdminNonAktif' => [
            'home',
            //'user.index', 
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'master_menu',
            'jenis.index', 'jenis.cetak', //'jenis.create', 'jenis.store', 'jenis.edit', 'jenis.update', 'jenis.destroy', 'jenis.cetak',
            'kelas.index', 'kelas.cetak',//'kelas.create', 'kelas.store', 'kelas.edit', 'kelas.update', 'kelas.destroy', 
            'siswa.index', 'siswa.cetak',//'siswa.create', 'siswa.store', 'siswa.edit', 'siswa.update', 'siswa.destroy', 
            'event.index', 'event.cetak', 'event.cetak',
            'guru.index', 'guru.cetak',
            //'guru.create', 'guru.store', 'guru.edit', 'guru.update', 'guru.destroy', 
            'kompetensi.index', 'kompetensi.cetak',//'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 
            'indikator.index', 'indikator.cetak',//'indikator.create', 'indikator.store', 'indikator.edit', 'indikator.update', 'indikator.destroy', 
            'kompetensi.index', 'kompetensi.cetak',// 'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 
            'solusi.index', 'solusi.cetak',// 'solusi.create', 'solusi.store', 'solusi.edit', 'solusi.update', 'solusi.destroy', 
            'relasi.index','relasi.cetak',//'relasi.create', 'relasi.store', 'relasi.edit', 'relasi.update', 'relasi.destroy',  'relasi.aturan',
            //'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.detail', 'histori.cetak', //'histori.destroy',
        ],
        'Guru' => [
            'home',
            'master_menu',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'event.view',
            'jenis.index', 'jenis.create', 'jenis.store', 'jenis.edit', 'jenis.update', 'jenis.destroy', 'jenis.cetak',
            'siswa.index', 'siswa.create', 'siswa.store', 'siswa.edit', 'siswa.update', 'siswa.destroy', 'siswa.cetak',
            'kompetensi.index', 'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 'kompetensi.cetak',
            'indikator.index', 'indikator.create', 'indikator.store', 'indikator.edit', 'indikator.update', 'indikator.destroy', 'indikator.cetak',
            'kompetensi.index', 'kompetensi.create', 'kompetensi.store', 'kompetensi.edit', 'kompetensi.update', 'kompetensi.destroy', 'kompetensi.cetak',
            'solusi.index', 'solusi.create', 'solusi.store', 'solusi.edit', 'solusi.update', 'solusi.destroy', 'solusi.cetak',
            'relasi.index', 'relasi.create', 'relasi.store', 'relasi.edit', 'relasi.update', 'relasi.destroy', 'relasi.cetak', 'relasi.aturan',
            'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak', 'histori.detail', 'histori.destroy',
        ],
        'GuruNonAktif' => [
            'home',
            'master_menu',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'event.view',
            'jenis.index', 'jenis.cetak',
            'siswa.index', 'siswa.cetak',
            'kompetensi.index', 'kompetensi.cetak',
            'indikator.index', 'indikator.cetak',
            'kompetensi.index','kompetensi.cetak',
            'solusi.index', 'solusi.cetak',
            'relasi.index', 'relasi.cetak', 'relasi.aturan',
            'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak', 'histori.detail', 
        ],
        'Siswa' => [
            'home',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'event.view',
            'hitung.pra', 'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak', 'histori.detail',
        ],
        'SiswaNonAktif' => [
            'home',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'event.view',
            // 'hitung.pra', 'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak', 'histori.detail',
        ],
        'User' => [
            'home',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'hitung.pra', 'hitung.index', 'hitung.cetak', 'hitung.action', 'hitung.ulang', 'hitung.indikator', 'hitung.indikator_action',
            'histori.index', 'histori.cetak',
        ],
        'Guest' => [
            'page.informasi', 'page.pakar',
            'login', 'daftar',
        ]
    ];
    $user = Auth::user();
    if ($user) {
        $level = $user->level;
        if ($level == 'Siswa' && !$user->status_user) {
            $level = 'SiswaNonAktif';
        }
        else if($level == 'Admin' && !$user->status_user) {
            $level = 'AdminNonAktif';
        }
        else if ($level == 'Guru' && !$user->status_user) {
            $level = 'GuruNonAktif';
        }
    } else {
        $level = 'Guest';
    }
    if (in_array($level, array_keys($role))) {
        return in_array($action, $role[$level]);
    }
}

function is_admin()
{
    return Auth::user()->level == 'Admin';
}
function is_guru()
{
    return Auth::user()->level == 'Guru';
}

function is_user()
{
    return Auth::user()->level == 'User';
}
function is_siswa()
{
    return Auth::user()->level == 'Siswa';
}
function enter_to_br($str)
{
    return str_ireplace("\r\n", "<br />", $str);
}
function format_date($data, $format = 'd-M-Y')
{
    return date($format, strtotime($data));
}
function get_hasil($relasi)
{
    foreach ($relasi as $key => $val) {
        foreach ($val as $k => $v) {
            if ($v != 'Ya')
                unset($relasi[$key]);
        }
    }
    return $relasi;
}

function eliminate_relasi(&$relasi)
{
    foreach ($relasi as $key => $val) {
        $tidak = 0;
        foreach ($val as $k => $v) {
            if ($v == 'Tidak')
                $tidak++;
        }
        if ($tidak >= 1 /*$tidak >= 2 || $tidak >= count($val) / 2*/)
            unset($relasi[$key]);
    }
    // echo '<pre>' . print_r($relasi, 1) . '</pre>';
}
function  get_next_indikator($relasi)
{
    eliminate_relasi($relasi);
    foreach ($relasi as $key => $val) {
        foreach ($val as $k => $v) {
            if ($v == '')
                return $k;
        }
    }
    return false;
}
function get_relasi($terjawab)
{
    $rows = get_results("SELECT kode_kompetensi, r.kode_indikator 
        FROM tb_relasi r
        ORDER BY kode_kompetensi, r.kode_indikator");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kompetensi][$row->kode_indikator] = isset($terjawab[$row->kode_indikator]) ? $terjawab[$row->kode_indikator] : '';
    }
    //echo '<pre>' . print_r($terjawab, 1) . '</pre>';
    return $arr;
}
function get_terjawab()
{
    $rows = get_results("SELECT kode_indikator, jawaban FROM tb_konsultasi");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_indikator] = $row->jawaban;
    }
    return $arr;
}
function get_kompetensi()
{
    $rows = get_results("SELECT * FROM tb_kompetensi ORDER BY kode_kompetensi");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kompetensi] = $row;
    }
    return $arr;
}

function get_indikator()
{
    $rows = get_results("SELECT * FROM tb_indikator ORDER BY kode_indikator");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_indikator] = $row;
    }
    return $arr;
}

function get_kompetensi_option($selected = '')
{
    $rows = get_results("SELECT * FROM tb_kompetensi ORDER BY kode_kompetensi");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_kompetensi == $selected)
            $a .= '<option value="' . $row->kode_kompetensi . '" selected>' . $row->kode_kompetensi . ' - ' . $row->nama_kompetensi . '</option>';
        else
            $a .= '<option value="' . $row->kode_kompetensi . '">' . $row->kode_kompetensi . ' - ' . $row->nama_kompetensi . '</option>';
    }
    return $a;
}

function get_indikator_option($selected = '')
{
    $rows = get_results("SELECT * FROM tb_indikator ORDER BY kode_indikator");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_indikator == $selected)
            $a .= '<option value="' . $row->kode_indikator . '" selected>' . $row->kode_indikator . ' - ' . $row->nama_indikator . '</option>';
        else
            $a .= '<option value="' . $row->kode_indikator . '">' . $row->kode_indikator . ' - ' . $row->nama_indikator . '</option>';
    }
    return $a;
}

function get_image_url($file)
{

    if (File::exists($file) && File::isFile($file))
        return asset($file);
    else
        return asset('images/no_image.png');
}
function current_user()
{
    return User::find(Auth::id());
}

function get_cf_user_option($selected = null)
{
    $arr = [
        '0' => 'Tidak Tahu',
        '0.4' => 'Mungkin',
        '0.6' => 'Kemungkinan Besar',
        '0.8' => 'Hampir Bisa',
        '1' => 'Bisa/Pasti',
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected . '_' == $key . '_')
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_level_option($selected = '')
{
    $arr = [
        'Admin' => 'Admin',
        'User' => 'User'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}
function get_jk_option($selected = '')
{
    $arr = [
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_status_user_option($selected = '')
{
    $arr = [
        1 => 'Aktif',
        0 => 'NonAktif'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function show_error($errors)
{
    if ($errors->any()) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="m-0 pl-3">';
        foreach ($errors->all() as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>';
    }
}
function show_msg()
{
    if ($messsage = session()->get('message')) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
            . $messsage . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}

function rp($number)
{
    return 'Rp ' . number_format($number);
}

function kode_oto($field, $table, $prefix, $length)
{
    $var = get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . ((int)substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_row($sql = '')
{
    $rows =  DB::select($sql);
    if ($rows)
        return $rows[0];
}

function get_results($sql = '')
{
    return DB::select($sql);
}

function get_var($sql = '')
{
    $row = DB::select($sql);
    if ($row) {
        return current(current($row));
    }
}

function query($sql, $params = [])
{
    return DB::statement($sql, $params);
}

function get_jenis_option($selected = '')
{
    $rows = get_results("SELECT * FROM tb_jenis ORDER BY kode_jenis");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_jenis == $selected)
            $a .= '<option value="' . $row->kode_jenis . '" selected>' . $row->nama_jenis . '</option>';
        else
            $a .= '<option value="' . $row->kode_jenis . '">' . $row->nama_jenis . '</option>';
    }
    return $a;
}

function get_kelas_option($selected = '')
{
    $rows = get_results("SELECT * FROM tb_kelas ORDER BY kode_kelas");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_kelas == $selected)
            $a .= '<option value="' . $row->kode_kelas . '" selected>' . $row->nama_kelas . '</option>';
        else
            $a .= '<option value="' . $row->kode_kelas . '">' . $row->nama_kelas . '</option>';
    }
    return $a;
}

function get_periode_option($selected = '')
{
    $arr = [
        'Ganjil' => 'Ganjil',
        'Genap' => 'Genap',
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function br_to_enter($str)
{
    return str_replace("\n", '<br />', $str);
}
