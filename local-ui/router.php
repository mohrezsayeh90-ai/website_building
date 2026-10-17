<?php
declare(strict_types=1);

// Isolated UI renderer. It never loads the original controllers or models.
ini_set('display_errors', '0');
error_reporting(E_ALL);
set_error_handler(static function (int $severity, string $message, string $file, int $line): bool {
    if (!(error_reporting() & $severity)) return false;
    throw new ErrorException($message, 0, $severity, $file, $line);
});

const UI_BASE = '/mehrabad';
const Base_Url = UI_BASE;
$projectRoot = __DIR__;
$candidates = [getenv('MEHRABAD_SITE_ROOT') ?: '', __DIR__.'/../Apache24/htdocs/mehrabad', __DIR__.'/../../Apache24/htdocs/mehrabad'];
if (is_file(__DIR__.'/local.json')) {
    $config = json_decode(file_get_contents(__DIR__.'/local.json'), true, 512, JSON_THROW_ON_ERROR);
    array_unshift($candidates, $config['site_root'] ?? '');
}
$siteRoot = null;
foreach ($candidates as $candidate) {
    if ($candidate !== '' && is_dir($candidate.'/assets')) { $siteRoot = realpath($candidate); break; }
}

function reply(int $status, string $message): never {
    http_response_code($status);
    header('Content-Type: text/plain; charset=utf-8');
    echo $message;
    exit;
}
function sendAsset(string $file): never {
    $types = ['css'=>'text/css','js'=>'text/javascript','svg'=>'image/svg+xml','png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','gif'=>'image/gif','webp'=>'image/webp','ico'=>'image/x-icon','ttf'=>'font/ttf','woff'=>'font/woff','woff2'=>'font/woff2','json'=>'application/json'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (!isset($types[$ext])) reply(404, 'Not found');
    header('Content-Type: '.$types[$ext]);
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: no-cache');
    readfile($file);
    exit;
}
function safeFile(string $base, string $relative): ?string {
    $base = realpath($base);
    if ($base === false) return null;
    $file = realpath($base.DIRECTORY_SEPARATOR.$relative);
    if ($file === false || !is_file($file) || !str_starts_with($file, $base.DIRECTORY_SEPARATOR)) return null;
    return $file;
}

$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
if (!in_array($_SERVER['REQUEST_METHOD'], ['GET','HEAD'], true)) reply(405, 'This UI uses sample data. Server writes are disabled.');
if (str_contains($path, "\0") || str_contains($path, '\\') || in_array('..', explode('/', $path), true)) reply(400, 'Invalid path');
if ($path === '/favicon.ico') { http_response_code(204); exit; }
if (str_starts_with($path, '/ui/')) {
    $file = safeFile(__DIR__.'/public/ui', substr($path, 4));
    if ($file) sendAsset($file);
    reply(404, 'Not found');
}
if (preg_match('~^/(?:mehrabad/)?assets/(.+)$~', $path, $match)) {
    $relative = $match[1];
    // Only UI assets may be read from the existing site. Never PHP, config or uploads.
    if (!preg_match('~^(?:css/|fonts/|lib/css/|images/(?:logo\.png|picture3\.png|signature\.png|magnifier\.png|projects-icon\.png|background\.png|wavy-background_prev_ui\.png)$)~i', $relative)) reply(404, 'Not found');
    if ($siteRoot && ($file = safeFile($siteRoot.'/assets', $relative))) sendAsset($file);
    if ($file = safeFile(__DIR__.'/public/assets', $relative)) sendAsset($file);
    if (str_starts_with($relative, 'images/')) {
        header('Content-Type: image/svg+xml');
        echo '<svg xmlns="http://www.w3.org/2000/svg" width="140" height="70" viewBox="0 0 140 70"><rect width="140" height="70" rx="8" fill="#e8f1f2"/><text x="70" y="41" text-anchor="middle" font-family="sans-serif" font-size="18" fill="#45979d">MEHRABAD</text></svg>';
        exit;
    }
    reply(404, 'Asset unavailable');
}
if ($path === '/' || $path === UI_BASE || $path === UI_BASE.'/') { header('Location: '.UI_BASE.'/home', true, 302); exit; }

$projects = json_decode(file_get_contents(__DIR__.'/data/projects.json'), true, 512, JSON_THROW_ON_ERROR);
$route = trim(substr($path, strlen(UI_BASE)), '/');
if (!str_starts_with($path, UI_BASE.'/')) reply(404, 'Not found');
$detailRoutes = ['prjman/show','project/editp','prjman/epl','prjman/dpl'];
$selected = null;
if (in_array($route, $detailRoutes, true)) {
    $code = $_GET['p'] ?? '';
    if (!is_string($code)) reply(400, 'Invalid project code');
    foreach ($projects as $project) if ($project['proj_code'] === $code) $selected = $project;
    if (!$selected) reply(404, 'Project not found');
} elseif (!in_array($route, ['home','prjman','source-map'], true)) reply(404, 'Page not available in the local UI');

// Display-only persona: no real login, credential, or authorization bypass.
$_SESSION = ['tim'=>501, 'admin'=>'local-sample', 'tkeNn'=>'کاربر آزمایشی'];
$renderer = new LocalUI($siteRoot, $route, $selected);
try { $renderer->render($projects); }
catch (Throwable $error) { error_log((string)$error); reply(500, 'UI rendering failed. See the terminal log.'); }

final class LocalUI {
    public function __construct(private ?string $siteRoot, private string $route, private ?array $project) {}
    public function url(string $path): string { return UI_BASE.'/'.ltrim($path, '/'); }
    // Existing templates use both echo expressions and statement-style asset calls.
    public function asset(string $path): string { echo htmlspecialchars(UI_BASE.'/assets/'.$path, ENT_QUOTES, 'UTF-8'); return ''; }
    public function includeFile(string $name): void {
        if ($name === 'layouts/partials/header') $this->header();
        elseif ($name === 'layouts/partials/open-tags-tmp') echo '<main class="ui-main"><div class="ui-content">';
        elseif ($name === 'layouts/partials/close-tags-tmp') echo '</div></main>';
        elseif (!in_array($name, ['layouts/partials/back-to-top','layouts/scripts'], true)) throw new RuntimeException('Unexpected include: '.$name);
    }
    private function originalAsset(string $relative): bool { return $this->siteRoot !== null && safeFile($this->siteRoot.'/assets', $relative) !== null; }
    private function header(): void {
        $title = match($this->route) { 'prjman'=>'فهرست پروژه‌ها', 'home'=>'داشبورد', 'prjman/epl'=>'اسناد EPL', 'prjman/dpl'=>'اسناد DPL', 'source-map'=>'راهنمای تغییر دکمه', default=>'شناسنامهٔ پروژه' };
        echo '<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.$title.' | مهرآباد — محلی</title>';
        $utility = $this->originalAsset('lib/css/outputWind.css') ? UI_BASE.'/assets/lib/css/outputWind.css' : '/ui/utilities.css';
        $icons = $this->originalAsset('lib/css/fonts/font-awesome.min.css') ? UI_BASE.'/assets/lib/css/fonts/font-awesome.min.css' : '/ui/vendor/font-awesome/css/font-awesome.min.css';
        foreach ([$utility,$icons,UI_BASE.'/assets/css/variables.css',UI_BASE.'/assets/css/general.css',UI_BASE.'/assets/css/special.css','/ui/local.css'] as $css) echo '<link rel="stylesheet" href="'.$css.'">';
        if (!$this->originalAsset('fonts/IRANSans(FaNum).ttf')) echo '<style>@font-face{font-family:primaryFont;src:url("/ui/fonts/FallbackSans.ttf") format("truetype")}</style>';
        echo '</head><body class="personal-panel"><header class="ui-header"><button id="menu-toggle" aria-label="باز کردن منو" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button><a class="ui-brand" href="'.$this->url('home').'">مهرآباد <small>سامانهٔ مدیریت پروژه‌ها</small></a><span class="ui-user"><i class="fa fa-user-circle-o" aria-hidden="true"></i> کاربر آزمایشی</span></header>';
        echo '<aside class="ui-sidebar" id="ui-sidebar"><div class="ui-sidebar-label">سامانهٔ جامع کسب‌وکار</div><nav aria-label="منوی اصلی">';
        foreach (['home'=>['داشبورد','fa-home'],'prjman'=>['پروژه‌ها','fa-folder-open-o'],'source-map'=>['راهنمای تغییر دکمه','fa-code']] as $page=>$item) {
            $active = $this->route === $page || $page === 'prjman' && in_array($this->route,['prjman/show','project/editp','prjman/epl','prjman/dpl'],true);
            echo '<a '.($active?'aria-current="page"':'').' href="'.$this->url($page).'"><i class="fa '.$item[1].'" aria-hidden="true"></i>'.$item[0].'</a>';
        }
        echo '</nav><p class="ui-sidebar-note">نسخهٔ محلی با دادهٔ آزمایشی</p></aside><div class="ui-notice">قالب صفحات از سورس سایت است؛ اطلاعات نمونه‌اند و ذخیرهٔ تغییرات فقط در همین مرورگر انجام می‌شود.</div>';
    }
    public function render(array $projects): void {
        $incompleteProj = array_values(array_filter($projects, fn($p)=>$p['proj_status'] < 100));
        $completeProj = array_values(array_filter($projects, fn($p)=>$p['proj_status'] >= 100));
        $ProjData = $this->project;
        $OtherProjData = $this->sampleDetails($ProjData);
        $files = [];
        ob_start();
        try {
            if ($this->route === 'prjman') require __DIR__.'/source/project/prjman.php';
            elseif (in_array($this->route,['prjman/show','project/editp'],true)) require __DIR__.'/source/project/showprj.php';
            else { $this->header(); echo '<main class="ui-main"><div class="ui-content">'; $this->extraPage($projects); echo '</div></main>'; }
            $html = ob_get_clean();
        } catch (Throwable $error) { ob_end_clean(); throw $error; }
        // Original scripts depend on absent backend endpoints. Display-only handlers replace them here.
        $html = preg_replace('~<script\b[^>]*>.*?</script>~is','',$html);
        $html = preg_replace_callback('~\s(on\w+)\s*=\s*([\x22\x27])(.*?)\2~is', static function ($m) {
            return ' data-ui-'.$m[1].'="'.htmlspecialchars(html_entity_decode($m[3], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8').'"';
        }, $html);
        header('Content-Type: text/html; charset=utf-8');
        header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'; frame-src 'self'; object-src 'none'; base-uri 'none'; form-action 'none'");
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: no-store');
        echo $html;
        echo '<div id="ui-toast" role="status" hidden></div><dialog id="ui-dialog"><button type="button" id="dialog-close" aria-label="بستن">×</button><h2 id="dialog-title"></h2><div id="dialog-body"></div></dialog>';
        echo '<script type="application/json" id="ui-state">'.json_encode(['route'=>$this->route,'code'=>$ProjData['proj_code']??null],JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT).'</script><script src="/ui/local.js" defer></script></body></html>';
    }
    private function sampleDetails(?array $p): array {
        if (!$p) return [];
        return [
            [['proj_item_mah_cod'=>'SAMPLE-01','proj_item_description'=>'تابلو برق نمونه — '.$p['proj_code'],'proj_item_number'=>'۲','proj_item_panel_type'=>'ایستاده','proj_item_ptFix'=>'ثابت','proj_item_color'=>'RAL 7035','proj_item_access_type'=>'از جلو','proj_item_cover'=>'فلزی','proj_item_protection_grade'=>'IP54','proj_item_breaking_power'=>'25kA','proj_item_order_no'=>'TEST-01','proj_item_serial_no'=>'SAMPLE-001']],
            [['proj_f_item_mah_cod'=>'SAMPLE-01','proj_f_item_description'=>'تابلو نمونه '.$p['proj_code'],'proj_f_item_numbers'=>'2','proj_f_item_cost_rial'=>'150000000']],
            [['risk_type'=>'آزمایشی','risk_description'=>'تأخیر در تأمین نمونه','risk_effects'=>'تغییر زمان تحویل','risk_coping_strategy'=>'برنامه‌ریزی تأمین جایگزین']],
            [['proj_financial_calculation_refrence'=>'مبالغ صرفاً آزمایشی هستند','proj_payment_currency_type'=>1]],
            [['list_of_equipment_in_customer_commitment'=>'تجهیزات نمونهٔ کارفرما','proj_packing_type'=>'بسته‌بندی آزمایشی','proj_other_important_notes'=>'این شناسنامه به '.$p['proj_code'].' تعلق دارد.','proj_signers'=>'','user_id'=>'']],
            ['proj_main_forms_version'=>'V1']
        ];
    }
    private function extraPage(array $projects): void {
        if ($this->route === 'home') {
            echo '<h1 class="ui-title">داشبورد مدیریت پروژه‌ها</h1><p class="ui-subtitle">نسخهٔ محلی برای بررسی صفحات و جای دکمه‌ها</p><div class="ui-stats">';
            foreach ([['کل پروژه‌ها',count($projects),'fa-folder-open-o'],['در جریان',count(array_filter($projects,fn($p)=>$p['proj_status']<100)),'fa-tasks'],['تکمیل‌شده',count(array_filter($projects,fn($p)=>$p['proj_status']>=100)),'fa-check-circle-o']] as [$label,$count,$icon]) echo '<a href="'.$this->url('prjman').'" class="ui-stat"><i class="fa '.$icon.'"></i><strong>'.$count.'</strong><span>'.$label.'</span></a>';
            echo '</div><section class="ui-panel"><h2>پروژه‌های نمونه</h2><div class="ui-project-cards">';
            foreach ($projects as $p) echo '<a class="ui-project-card" href="'.$this->url('prjman/show/?p='.$p['proj_code']).'"><span class="ui-code">'.$p['proj_code'].'</span><h3>'.$p['proj_name'].'</h3><p>'.$p['nam'].'</p><span>مشاهدهٔ شناسنامه ←</span></a>';
            echo '</div></section>';
        } elseif ($this->route === 'source-map') {
            echo '<h1 class="ui-title">راهنمای تغییر جای دکمه</h1><section class="ui-panel"><p>فهرست پروژه‌ها و شناسنامه با قالب PHP دریافتی نمایش داده می‌شوند. سربرگ و داشبورد برای اجرای محلی ساخته شده‌اند.</p><table class="ui-simple-table"><thead><tr><th>صفحه</th><th>فایل همین بسته</th><th>دکمه یا محل</th></tr></thead><tbody><tr><td>فهرست پروژه‌ها</td><td dir="ltr">source/project/prjman.php</td><td>ستون عملیات و دکمه‌های DCC، EPL و DPL</td></tr><tr><td>شناسنامهٔ پروژه</td><td dir="ltr">source/project/showprj.php</td><td dir="ltr">saveAllSheetsprj · reloadAllSheets · ender_return</td></tr><tr><td>ظاهر محلی</td><td dir="ltr">public/ui/local.css</td><td>سربرگ، منو و تنظیمات نمایش محلی</td></tr></tbody></table><p>ذخیرهٔ شناسنامه فقط یک پیش‌نویس در مرورگر می‌سازد. ورود واقعی، گردش تأیید، ارسال ایمیل و تولید Excel/PDF سایت اصلی در این نسخه اجرا نمی‌شوند.</p></section>';
        } else {
            $p=$this->project; $kind=$this->route==='prjman/epl'?'EPL':'DPL';
            echo '<h1 class="ui-title">اسناد '.$kind.' — '.$p['proj_code'].'</h1><p class="ui-subtitle">'.$p['proj_name'].' · جدول آزمایشی برای بررسی مسیر صفحات</p><section class="ui-panel"><a class="ui-back" href="'.$this->url('prjman/show/?p='.$p['proj_code']).'">بازگشت به شناسنامه</a><table class="ui-simple-table"><thead><tr><th>ردیف</th><th>شرح</th><th>تعداد</th><th>وضعیت</th></tr></thead><tbody><tr><td>۱</td><td>تجهیزات نمونهٔ '.$p['proj_code'].'</td><td>۲</td><td>آزمایشی</td></tr></tbody></table><p>قالب این جدول محلی است؛ فرم کامل '.$kind.' سایت اصلی بازسازی نشده است.</p></section>';
        }
    }
}
