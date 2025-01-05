<?php

namespace App\Http\Controllers; // تعريف مساحة الاسم الخاصة بالتحكم في الفئات

use App\Models\Category; // استيراد نموذج الفئة (Category) من مجلد النماذج
use Illuminate\Http\Request; // استيراد الكلاس Request من إطار العمل Laravel

class CategoryController extends Controller // تعريف فئة CategoryController التي ترث من فئة Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // دالة تعرض قائمة بجميع الفئات
    {
        $categories = Category::all(); // جلب جميع الفئات من قاعدة البيانات وتخزينها في متغير $categories
        return view('categories.index', compact('categories')); // إرجاع العرض الخاص بالفئات مع تمرير البيانات
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // دالة لعرض نموذج لإنشاء فئة جديدة
    {
        $category = new Category(); // إنشاء كائن جديد من الفئة Category
        return view('categories.create', compact('category')); // إرجاع العرض الخاص بإنشاء فئة جديدة مع تمرير الكائن
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // دالة لتخزين الفئة الجديدة في قاعدة البيانات
    {
        // تحقق من صحة البيانات المرسلة في الطلب
        $request->validate([
            'name' => 'required|string|max:255', // التأكد من أن الاسم مطلوب وأنه نصي وألا يتجاوز 255 حرفًا
        ]);

        // إنشاء سجل جديد في قاعدة البيانات للفئة باستخدام البيانات المرسلة
        Category::create([
            'name' => $request->input('name'), // استخدام القيمة المدخلة لاسم الفئة
        ]);

        // إعادة توجيه المستخدم إلى صفحة الفئات مع رسالة نجاح
        return redirect()->route('categories.index')->with('success', 'تم إضافة الفئة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) // دالة لعرض تفاصيل فئة معينة
    {
        // يمكن تنفيذ العمليات هنا لعرض تفاصيل الفئة إذا لزم الأمر
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category) // دالة لعرض نموذج تعديل فئة معينة
    {
        return view('categories.edit', compact('category')); // إرجاع العرض الخاص بتعديل الفئة مع تمرير الكائن
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category) // دالة لتحديث بيانات فئة معينة
    {
        // تحقق من صحة البيانات المرسلة في الطلب
        $request->validate([
            'name' => 'required|string|max:255', // التأكد من أن الاسم مطلوب وأنه نصي وألا يتجاوز 255 حرفًا
        ]);

        // تحديث بيانات الفئة المحددة في قاعدة البيانات باستخدام البيانات المرسلة
        $category->update([
            'name' => $request->input('name'), // استخدام القيمة المدخلة لاسم الفئة
        ]);

        // إعادة توجيه المستخدم إلى صفحة الفئات مع رسالة نجاح
        return redirect()->route('categories.index')->with('success', 'تم تعديل الفئة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) // دالة لحذف فئة معينة
    {
        $category->delete(); // حذف الفئة المحددة من قاعدة البيانات
        // إعادة توجيه المستخدم إلى صفحة الفئات مع رسالة نجاح
        return redirect()->route('categories.index')->with('success', 'تم حذف الفئة بنجاح!');
    }
}
