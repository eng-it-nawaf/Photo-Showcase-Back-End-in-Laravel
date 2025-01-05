<?php

use App\Http\Controllers\ProfileController; // استيراد وحدة التحكم الخاصة بالملف الشخصي
use App\Http\Controllers\CategoryController; // استيراد وحدة التحكم الخاصة بالفئات
use App\Http\Controllers\PostController; // استيراد وحدة التحكم الخاصة بالمشاركات
use Illuminate\Support\Facades\Route; // استيراد واجهة Route من إطار العمل Laravel

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| هنا هو المكان الذي يمكنك فيه تسجيل مسارات الويب لتطبيقك. هذه
| المسارات يتم تحميلها بواسطة RouteServiceProvider وكلها سيتم
| تعيينها إلى مجموعة الوسائط "web". اجعل شيئًا عظيمًا!
|
*/

// المسار الرئيسي للتطبيق
Route::get('/', function () {
    return view('welcome'); // إرجاع عرض الصفحة الرئيسية
});

// المسار لصفحة لوحة التحكم
Route::get('/dashboard', function () { 
    return view('dashboard'); // إرجاع عرض لوحة التحكم
})->middleware(['auth', 'verified'])->name('dashboard'); // تطبيق الوسائط للتحقق من المستخدم

// مجموعة من المسارات تتطلب مصادقة المستخدم
Route::middleware('auth')->group(function () {
    // المسار لتحرير الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // عرض نموذج تحرير الملف الشخصي
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // تحديث الملف الشخصي
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // حذف الملف الشخصي

    // موارد الفئات مع شرط أن يكون المستخدم هو المسؤول
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('is_admin'); 

    // موارد المشاركات
    Route::resource('posts', \App\Http\Controllers\PostController::class); // إدارة المشاركات
}); 

// إعادة تعريف المسار لصفحة لوحة التحكم (يبدو أن هناك تكرار)
Route::get('/dashboard', function () { 
    return view('dashboard'); // إرجاع عرض لوحة التحكم
})->name('dashboard');

// تحميل ملفات التعريف الخاصة بالمستخدمين
require __DIR__.'/auth.php'; // ت~حميل ملفات المصادقة

// تعريف موارد الفئات مرة أخرى (هناك تكرار في التعريف)
Route::resource('categories', \App\Http\Controllers\CategoryController::class); 

// المسار لعرض تفاصيل مشاركة معينة
Route::get('/posts/{postId}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show'); // عرض تفاصيل المشاركة

// تحديث فئة معينة
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // تحديث الفئة

// موارد الفئات (تكرار التعريف)
Route::resource('categories', CategoryController::class); // إدارة الفئات

// موارد المشاركات (تكرار التعريف)
Route::resource('posts', PostController::class); // إدارة المشاركات
