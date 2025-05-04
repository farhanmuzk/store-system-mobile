    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\{
        ProfileController,
        ProductController,
        RoleController,
        NotificationController,
        PaymentController,
        NegotiationController,
        IncomingOrderController,
        ProductDataController,
        MoneySupplyController,
        MarketingController,
        ContentRequirementsController,
        SendingReportController
    };

    // ========== Auth & Login ==========
    Route::get('/', fn () => view('auth.login'));
    Route::get('/espector', fn () => view('espector'))->middleware(['auth', 'verified'])->name('espector');
    Route::post('/verify-code', [RoleController::class, 'verifyCode'])->name('verify.code');
    Route::post('/logout-admin', [RoleController::class, 'logoutAdmin'])->name('logout.admin');

    // ========== Dashboard ==========
    Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

    // ========== Executing ==========
    Route::get('/excuting', fn () => view('pages.excuting.index'))->middleware(['auth', 'verified'])->name('excuting');
    Route::get('/ordering', fn () => view('pages.excuting.ordering_page.index'))->middleware(['auth', 'verified'])->name('ordering');
    Route::get('/paying', fn () => view('pages.excuting.paying_page.index'))->middleware(['auth', 'verified'])->name('paying');
    Route::get('/paying-page', fn () => view('pages.excuting.paying_page.paying_page'))->middleware(['auth', 'verified'])->name('paying-page');
    Route::match(['get', 'post'], '/paying-member', [MoneySupplyController::class, 'index'])->name('paying-member');


    Route::get('/riwayat', fn () => view('pages.excuting.paying_page.riwayat_page'))->middleware(['auth', 'verified'])->name('/riwayat');
    Route::get('/monitoring', fn () => view('pages.excuting.monitoring_page.index'))->middleware(['auth', 'verified'])->name('/monitoring');
    Route::get('/monitoring-page', fn () => view('pages.excuting.monitoring_page.monitoring_page'))->middleware(['auth', 'verified'])->name('/monitoring-page');
    Route::get('/money-supply-monitoring', [MoneySupplyController::class, 'monitoringPage']) ->middleware(['auth', 'verified'])->name('monitoring-supply');
    Route::put('/money-supply-monitoring/update', [MoneySupplyController::class, 'updateFromMonitoring'])->middleware(['auth', 'verified'])->name('monitoring-supply.update');
    Route::get('/ordering-report', [SendingReportController::class, 'orderingReport'])->middleware(['auth', 'verified'])->name('ordering-report');
    Route::post('/ordering-report/update', [SendingReportController::class, 'updateTeks'])->middleware(['auth', 'verified'])->name('ordering-report.update');
    Route::get('/paying-report', [SendingReportController::class, 'payingReport'])->middleware(['auth', 'verified'])->name('paying-report');
    Route::post('/paying-report/update', [SendingReportController::class, 'updateTeks_paying'])->middleware(['auth', 'verified'])->name('paying-report.update');
    Route::post('/money-supply-upload/upload', [MoneySupplyController::class, 'uploadMoneySupply'])->name('money-supply-upload');
    Route::get('/gallery-order', [NotificationController::class, 'orderApproval'])->name('gallery-order');
    Route::put('/gallery-order/{order}', [NotificationController::class, 'updateOrder'])->name('gallery-order.update');
    Route::get('/shipping-estimation', fn () => view('pages.negotiation.shipping_estimate_features_page.index'))->name('shiping-estimation');
    Route::get('/trouble-consultation', fn () => view('pages.negotiation.trouble_consultation_page.index'))->name('trouble-consultation');
    Route::get('/send-report', [SendingReportController::class, 'index'])->middleware(['auth', 'verified'])->name('send-report.index');
    Route::post('/send-report', [SendingReportController::class, 'store'])->middleware(['auth', 'verified'])->name('send-report.store');
    Route::get('/send-report-paying',  [SendingReportController::class, 'index_paying'])->middleware(['auth', 'verified'])->name('send-paying-report');
    Route::post('/send-report-paying', [SendingReportController::class, 'store_paying'])->middleware(['auth', 'verified'])->name('send-paying-report.store');

    Route::get('/incoming-notification', [IncomingOrderController::class, 'getNotifications'])->name('incoming-notification');
        Route::get('/history-notification', [IncomingOrderController::class, 'getNotifications'])->name('history-notification');

    // ========== Marketing ==========
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/marketing', fn () => view('pages.marketing.index'))->name('marketing');
        Route::get('/payment-page', fn () => view('pages.marketing.payment_page.index'))->name('payment-page');
        Route::get('/payment-success', fn () => view('pages.marketing.payment_page.payment_success'))->name('payment-success');
        Route::post('/marketing/store', [MarketingController::class, 'store'])->name('marketing.store');
        Route::get('/phone-number', fn () => view('pages.marketing.phone_number.index'))->name('phone-number');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/money-supply', [MoneySupplyController::class, 'index'])->name('money-supply');
        Route::post('/money-supply', [MoneySupplyController::class, 'store'])->name('money-supply.store');
        Route::put('/money-supply/update/{id}', [MoneySupplyController::class, 'updateMoneySupply'])->name('money-supply.update');
    });


    // ========== Payment ==========
    Route::middleware(['auth', 'verified'])->prefix('payment')->group(function () {
        Route::get('/choice/{id}', [PaymentController::class, 'showChoice'])->name('pages.marketing.payment_page.payment_choice');
        Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
        Route::put('/{id}/update', [PaymentController::class, 'updatePayment'])->name('payment.update');
    });

    // ========== Negotiation ==========
    Route::middleware(['auth', 'verified'])->prefix('negotiation')->group(function () {
        Route::get('/', [NegotiationController::class, 'index'])->name('pages.negotiation.index');
        Route::post('/', [NegotiationController::class, 'store'])->name('negotiation.store');
        Route::get('/verification', [NegotiationController::class, 'verification'])->name('negotiation.verification');


    });

    // ========== Incoming Order ==========
    Route::middleware(['auth', 'verified'])->prefix('incoming-order')->name('pages.negotiation.incoming_order_page.')->group(function () {
        Route::get('/', [IncomingOrderController::class, 'index'])->name('index');
        Route::post('/', [IncomingOrderController::class, 'store'])->name('store');
        Route::get('/{order}', [IncomingOrderController::class, 'edit'])->name('edit');
        Route::put('/{order}', [IncomingOrderController::class, 'update'])->name('update');

    });

    // ========== Product Data ==========
    Route::middleware(['auth', 'verified'])->prefix('product-data')->group(function () {
        Route::get('/', [ProductDataController::class, 'index'])->name('product-data');
        Route::post('/store', [ProductDataController::class, 'store'])->name('product-data.store');
    });

    // ========== Notification ==========
    Route::middleware(['auth', 'verified'])->prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('/', [NotificationController::class, 'store'])->name('notifications.store');
        Route::post('/{notification}/approve', [NotificationController::class, 'approve'])->name('notifications.approve');
        Route::post('/{notification}/reject', [NotificationController::class, 'reject'])->name('notifications.reject');

        Route::get('/order-approval', [NotificationController::class, 'orderApproval'])->name('notifications.order-approval');
        Route::put('/{notification}/update-plus', [NotificationController::class, 'updatePlus'])->name('notifications.updatePlus');
        Route::put('/{notification}/approve', [NotificationController::class, 'approve'])->name('notifications.approve.order');
        Route::put('/{notification}/reject', [NotificationController::class, 'rejectApproval'])->name('notifications.reject.order');


    });

    // ========== Substance ==========
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/substance', fn () => view('pages.marketing.substance_page.index'))->name('substance');
        Route::get('/about-product', [ProductController::class, 'index'])->name('pages.marketing.substance_page.about_product');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/content-requirements', [ContentRequirementsController::class, 'show'])->name('content-requirements');
        Route::post('/content-requirements', [ContentRequirementsController::class, 'store'])->name('content-requirements.store');
        Route::post('/update-user-hak-akses', [ContentRequirementsController::class, 'updateUserHakAkses'])->name('update-user-hak-akses');

    });

    // ========== Content Pages ==========
    Route::middleware(['auth', 'verified'])->prefix('content')->group(function () {
        Route::get('/1', fn () => view('pages.marketing.content_page.content-page-01'))->name('content-page-01');
        Route::get('/2', fn () => view('pages.marketing.content_page.content-page-02'))->name('content-page-02');
        Route::get('/3', fn () => view('pages.marketing.content_page.content-page-03'))->name('content-page-03');
        Route::get('/4', fn () => view('pages.marketing.content_page.content-page-04'))->name('content-page-04');
    });

    // ========== Profile ==========
    Route::middleware('auth')->prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // ========== Auth Routes ==========
    require __DIR__.'/auth.php';
