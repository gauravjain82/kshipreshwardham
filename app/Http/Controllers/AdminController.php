<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    public function Dashboard()
    {
       return view("Admin.dashboard");
    }

     public function Login()
    {
       return view("Admin.Auth.login");
    }
    public function logout(Request $request)
{
    $request->session()->forget('admin_id');

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

    public function AdminLogin(Request $request)
{
    $credentials = $request->only(["username", "password"]);

    $userExists = DB::table("admin")
        ->where("username", $credentials["username"])
        ->count();

    if ($userExists > 0) {
        $user = DB::table("admin")
            ->where("username", $credentials["username"])
            ->where("password", $credentials["password"])
            ->first();

        if (!empty($user)) {
            Session::put("admin_id", $user->id);
            Session::put("admin_username", $user->username);

            Cookie::queue("admin_id", $user->id, 60 * 24 * 30); 
            Cookie::queue("admin_username", $user->username, 60 * 24 * 30);

            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "redirect_url" => route("Dashboard"),
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid Username or Password",
            ]);
        }
    } else {
        return response()->json([
            "status" => false,
            "message" => "Invalid Username or Password",
        ]);
    }
}

    public function Hotel_add()
    {
       return view("Admin.hotel.add");
    }

    public function Course_list()
    {
       $data['courses'] = DB::table('course')->orderBy('id', 'desc')->get();
       return view("Admin.course.list",$data);
    }

    public function Course_edit($id)
    {
    $data['course'] = DB::table('course')->where('id', $id)->first();

    if (!$data['course']) {
        return redirect()->back()->with('error', 'Course not found.');
    }

    return view("Admin.course.edit", $data);
   }


    public function Course_store(Request $request)
{
    $request->validate([
        'course_name' => 'required|string|max:255',
        'course_price' => 'required|numeric',
        'course_discount' => 'nullable|numeric',
        'course_duration' => 'required|numeric',
        'course_description' => 'nullable|string',
        'course_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $profile = null;
    if ($request->hasFile('course_image')) {
        $imageName = time() . '.' . $request->course_image->extension();
        $request->course_image->move(public_path('admin/courses'), $imageName);
        $profile = "admin/courses/{$imageName}";
    }

    DB::table('course')->insert([
        'name' => $request->course_name,
        'price' => $request->course_price,
        'discount' => $request->course_discount,
        'duration' => $request->course_duration,
        'description' => $request->course_description,
        'image' => $profile,
        'created_at' => now(),
    ]);

     return response()->json([
        'success' => true, 
        'message' => 'Course Added successfully!', 
        'redirect' => route('Course_list')
    ]);
}

public function Course_update(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:course,id',
        'course_name' => 'required|string|max:255',
        'course_price' => 'required|numeric',
        'course_discount' => 'nullable|numeric',
        'course_duration' => 'required|numeric',
        'course_description' => 'nullable|string',
        'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $id = $request->input('id');

    $course = DB::table('course')->where('id', $id)->first();

    if (!$course) {
        return response()->json([
            'success' => false, 
            'message' => 'Course not found!', 
            'redirect' => route('Course_list')
        ]);
    }

    $profile = $course->image; 

    if ($request->hasFile('course_image')) {
        if (!empty($course->image) && file_exists(public_path($course->image))) {
            unlink(public_path($course->image));
        }

        $imageName = time() . '.' . $request->course_image->extension();
        $request->course_image->move(public_path('admin/courses'), $imageName);
        $profile = "admin/courses/{$imageName}";
    }

    DB::table('course')->where('id', $id)->update([
        'name' => $request->course_name,
        'price' => $request->course_price,
        'discount' => $request->course_discount,
        'duration' => $request->course_duration,
        'description' => $request->course_description,
        'image' => $profile,
    ]);

    return response()->json([
        'success' => true, 
        'message' => 'Course updated successfully!', 
        'redirect' => route('Course_list')
    ]);
}

public function Course_delete($id)
{
    $deleted = DB::table('course')->where('id', $id)->delete();

    if ($deleted) {
        return response()->json(['success' => true, 'message' => 'Course deleted successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Course not found'], 404);
    }
}

    public function Banner_list()
    {
       $data['banner'] = DB::table('banner')->orderBy('id', 'desc')->get();
       return view("Admin.banner.list",$data);
    }

        public function Banner_add()
    {
       return view("Admin.banner.add");
    }

   public function Banner_store(Request $request)
   {
    $request->validate([
        'banner_title' => 'required|string|max:255',
        'banner_desc' => 'required|string',
        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    $profile = null;
    if ($request->hasFile('banner_image')) {
        $imageName = time() . '.' . $request->banner_image->extension();
        $request->banner_image->move(public_path('admin/banner'), $imageName);
        $profile = "admin/banner/{$imageName}";
    }

    DB::table('banner')->insert([
        'banner_title' => $request->banner_title,
        'banner_desc' => $request->banner_desc,
        'banner_image' => $profile,
    ]);

     return response()->json([
        'success' => true, 
        'message' => 'Banner Added successfully!', 
        'redirect' => route('Banner_list')
    ]);
}

    public function Banner_edit($id)
    {
    $data['banner'] = DB::table('banner')->where('id', $id)->first();

    if (!$data['banner']) {
        return redirect()->back()->with('error', 'banner not found.');
    }

    return view("Admin.banner.edit", $data);
   }

  public function banner_update(Request $request, $id)
{
    $banner = DB::table('banner')->where('id', $id)->first();

    if (!$banner) {
        return response()->json(['success' => false, 'message' => 'Banner not found'], 404);
    }

    $data = ['banner_title' => $request->banner_title];

    if ($request->hasFile('banner_image')) {
        if ($banner->banner_image && file_exists(public_path($banner->banner_image))) {
            unlink(public_path($banner->banner_image));
        }

        $imageName = time() . '.' . $request->banner_image->extension();
        $request->banner_image->move(public_path('admin/banner'), $imageName);
        $data['banner_image'] = "admin/banner/{$imageName}";
    }

    DB::table('banner')->where('id', $id)->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Banner updated successfully',
        'redirect' => route('Banner_list')
    ]);
}

public function banner_delete($id)
{
    $deleted = DB::table('banner')->where('id', $id)->delete();

    if ($deleted) {
        return response()->json(['success' => true, 'message' => 'Banner deleted successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Banner not found'], 404);
    }
}

    public function FrontEnd()
    {
    $data['frontend'] = DB::table('setting')->first();
    return view("Admin.setting",$data);
    }

public function updateFrontend(Request $request)
{
    $data = DB::table('setting')->first();

    // ✅ ICON ARRAY HANDLE
    $iconNames = $request->icon_name ?? [];
    $iconUrls  = $request->icon_url ?? [];

    // remove empty rows
    $filteredIcons = [];
    foreach ($iconNames as $key => $name) {
        if (!empty($name) && !empty($iconUrls[$key])) {
            $filteredIcons[] = [
                'name' => $name,
                'url'  => $iconUrls[$key]
            ];
        }
    }

    $updateData = [
        'title' => $request->title,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,
        'whatsapp_number' => $request->whatsapp_number,
        'address' => $request->address,
        'footer_line' => $request->footer_line,

        // ✅ SAVE JSON
        'icon_name' => json_encode($filteredIcons),
    ];

    // 🔥 LOGO
    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
        if (!empty($data->logo) && file_exists(public_path($data->logo))) {
            unlink(public_path($data->logo));
        }

        $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(public_path('admin/logo'), $imageName);
        $updateData['logo'] = "admin/logo/{$imageName}";
    }

    // 🔥 FAVICON
    if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {
        if (!empty($data->favicon) && file_exists(public_path($data->favicon))) {
            unlink(public_path($data->favicon));
        }

        $faviconName = time() . '.' . $request->file('favicon')->getClientOriginalExtension();
        $request->file('favicon')->move(public_path('admin/favicon'), $faviconName);
        $updateData['favicon'] = "admin/favicon/{$faviconName}";
    }

    // 🔥 FOOTER LOGO
    if ($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()) {

        if (!empty($data->footer_logo) && file_exists(public_path($data->footer_logo))) {
            unlink(public_path($data->footer_logo));
        }

        $footer_logo = time() . '.' . $request->file('footer_logo')->getClientOriginalExtension();
        $request->file('footer_logo')->move(public_path('admin/footer_logo'), $footer_logo);

        $updateData['footer_logo'] = "admin/footer_logo/{$footer_logo}";
    }

    DB::table('setting')->update($updateData);

    return response()->json([
        'success' => true,
        'message' => 'Settings updated successfully!',
        'data' => $updateData,
    ]);
}


      public function Gallery()
    {
       return view("Admin.gallery.add");
    }

  public function Gallery_store(Request $request)
{
    $request->validate([
        'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'youtube_url'   => 'nullable|string'
    ]);

    // ❗ atleast ek required (image ya youtube)
    if (!$request->hasFile('gallery_image') && empty($request->youtube_url)) {
        return response()->json([
            'success' => false,
            'message' => 'Please upload image or enter YouTube URL'
        ]);
    }

    $imagePath = null;

    // IMAGE UPLOAD
    if ($request->hasFile('gallery_image')) {
        $image = $request->file('gallery_image');

        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
        $image->move(public_path('admin/banner'), $imageName);

        $imagePath = "admin/banner/{$imageName}";
    }

    // INSERT DATA
    DB::table('gallery')->insert([
        'gallery_images' => $imagePath,
        'youtube_url'    => $request->youtube_url,
        'created_at'     => now(),
        
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Data added successfully!',
       'redirect' => route('Gallerylist'),
    ]);
}

     public function Gallerylist()
    {
      $data['gallery'] = DB::table('gallery')->get();
       return view("Admin.gallery.list",$data);
    }

    public function Content()
    {
      $data['frontend'] = DB::table('content')->first();
       return view("Admin.content.form",$data);
    }

   public function update_content(Request $request)
{
    $content = DB::table('content')->where('id', $request->id)->first();

    if (!$content) {
        return response()->json([
            'success' => false,
            'message' => 'Content not found'
        ], 404);
    }

  
    $aboutImagePath = $content->about_us_image; 

    if ($request->hasFile('about_us_image')) {

        if ($content->about_us_image && file_exists(public_path($content->about_us_image))) {
            unlink(public_path($content->about_us_image));
        }

        $imageName = time().'_about.'.$request->about_us_image->extension();
        $request->about_us_image->move(public_path('admin/content'), $imageName);

        $aboutImagePath = "admin/content/".$imageName;
    }


    $data = [
        'about_us'        => $request->about_us,
        'vision'  => $request->vision,
        'terms_conditions'=> $request->terms_conditions,
        'privacy_policy'   => $request->privacy_policy,
        'support'         => $request->support,
        'about_us_image'  => $aboutImagePath
    ];

    DB::table('content')->where('id', $request->id)->update($data);

    return response()->json([
        'success'  => true,
        'message'  => 'Content updated successfully',
        'redirect' => route('website-content')
    ]);
}
 public function events_add()
    {
       return view("Admin.events.add");
    }

 public function events_list()
    {
       $data['events'] = DB::table('events')->orderBy('id', 'desc')->get();
       return view("Admin.events.list",$data);
    }

 public function Services_add()
    {
       return view("Admin.services.add");
    }

    public function Services_list()
    {
       $data['courses'] = DB::table('services')->orderBy('id', 'desc')->get();
       return view("Admin.services.list",$data);
    }

public function Services_store(Request $request)
{
    $request->validate([
        'service_name' => 'required|string|max:255',
    ]);

    $slideImagePath = null;
    $smallImagePath = null;

    /* =======================
       Slide Image Upload
    ======================= */
    if ($request->hasFile('slide_image')) {
        $slideImageName = time() . '_slide.' . $request->slide_image->extension();
        $request->slide_image->move(public_path('admin/service'), $slideImageName);
        $slideImagePath = "admin/service/{$slideImageName}";
    }

    /* =======================
       Small Image Upload
    ======================= */
    if ($request->hasFile('small_image')) {
        $smallImageName = time() . '_small.' . $request->small_image->extension();
        $request->small_image->move(public_path('admin/service'), $smallImageName);
        $smallImagePath = "admin/service/{$smallImageName}";
    }

    DB::table('services')->insert([
        'service_name' => $request->service_name,
        'description' => $request->description,
        'slide_image'  => $slideImagePath,
        'small_image'  => $smallImagePath,
        'created_at'   => now(),
    ]);

    return response()->json([
        'success'  => true,
        'message'  => 'Service Added successfully!',
        'redirect' => route('Services_list')
    ]);
}

public function Service_edit(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'service_name' => 'required|string|max:255',
      
    ]);

    $service = DB::table('services')->where('id', $request->id)->first();

    if (!$service) {
        return response()->json([
            'success' => false,
            'message' => 'Service not found.',
        ]);
    }

    $updateData = [
        'service_name' => $request->service_name,
        'description'  => $request->description,
        
    ];

    /* =========================
       Slide Image Update
    ========================= */
    if ($request->hasFile('slide_image')) {

        // Old image delete
        if (!empty($service->slide_image) && file_exists(public_path($service->slide_image))) {
            unlink(public_path($service->slide_image));
        }

        $slideImageName = uniqid() . '_slide.' . $request->slide_image->extension();
        $request->slide_image->move(public_path('admin/service'), $slideImageName);

        $updateData['slide_image'] = "admin/service/{$slideImageName}";
    }

    /* =========================
       Small Image Update
    ========================= */
    if ($request->hasFile('small_image')) {

        // Old image delete
        if (!empty($service->small_image) && file_exists(public_path($service->small_image))) {
            unlink(public_path($service->small_image));
        }

        $smallImageName = uniqid() . '_small.' . $request->small_image->extension();
        $request->small_image->move(public_path('admin/service'), $smallImageName);

        $updateData['small_image'] = "admin/service/{$smallImageName}";
    }

    DB::table('services')->where('id', $request->id)->update($updateData);

    return response()->json([
        'success'  => true,
        'message'  => 'Service updated successfully!',
        'redirect' => route('Services_list')
    ]);
}


    public function SubServices()
    {
       $data['services'] = DB::table('services')->get();
       return view("Admin.subServices.add",$data);
    }

public function SubService_store(Request $request)
{
    $request->validate([
        'service_id' => 'required|integer',
        'service_name' => 'required|string|max:255',
        'short_title' => 'nullable|string',
        'quarterly' => 'nullable|string',
        'half_yearly' => 'nullable|string',
        'yearly' => 'nullable|string',
        'bi_yearly' => 'nullable|string',
        'long_description' => 'nullable|string',
        'report' => 'nullable|file|mimes:pdf',
        'service_type' => 'nullable|string',
        'service_feature' => 'nullable|string',
        'tracksheet' => 'nullable|string',
        'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'titles' => 'nullable|array',
        'names' => 'nullable|array',
    ]);

    // Handle service_image upload
    $imagePath = null;
    if ($request->hasFile('service_image')) {
        $imageName = time() . '_image.' . $request->service_image->extension();
        $request->service_image->move(public_path('admin/service'), $imageName);
        $imagePath = "admin/service/{$imageName}";
    }

    // Handle report PDF upload
    $reportPath = null;
    if ($request->hasFile('report')) {
        $reportName = time() . '_report.' . $request->report->extension();
        $request->report->move(public_path('admin/service'), $reportName);
        $reportPath = "admin/service/{$reportName}";
    }

    // Handle dynamic titles and names as JSON object
    $returnData = [];
    $titles = $request->titles ?? [];
    $names = $request->names ?? [];

    foreach ($titles as $index => $title) {
        if (!empty($title) || !empty($names[$index] ?? '')) {
            $returnData[$title] = $names[$index] ?? null;
        }
    }

    DB::table('sub_services')->insert([
        'service_id'        => $request->service_id,
        'service_name'      => $request->service_name,
        'short_title'       => $request->short_title,
        'quarterly'         => $request->quarterly,
        'half_yearly'       => $request->half_yearly,
        'yearly'            => $request->yearly,
        'bi_yearly'         => $request->bi_yearly,
        'long_description'  => $request->long_description,
        'report'            => $reportPath,
        'service_type'      => $request->service_type,
        'service_feature'   => $request->service_feature,
        'tracksheet'        => $request->tracksheet,
        'service_image'     => $imagePath,
        'return'            => json_encode($returnData),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Sub Service Added Successfully!',
    ]);
}

public function SubService_edit($id)
{
    $subService = DB::table('sub_services')->where('id', $id)->first();
    $services = DB::table('services')->get();

    return view('Admin.SubServices.edit', compact('subService', 'services'));
}

public function SubService_update(Request $request, $id)
{
    $request->validate([
        'service_id' => 'required|integer',
        'service_name' => 'required|string|max:255',
        'short_title' => 'nullable|string',
        'quarterly' => 'nullable|string',
        'half_yearly' => 'nullable|string',
        'yearly' => 'nullable|string',
        'bi_yearly' => 'nullable|string',
        'long_description' => 'nullable|string',
        'report' => 'nullable|file|mimes:pdf',
        'service_type' => 'nullable|string',
        'service_feature' => 'nullable|string',
        'tracksheet' => 'nullable|string',
        'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'titles' => 'nullable|array',
        'names' => 'nullable|array',
    ]);

    $existing = DB::table('sub_services')->where('id', $id)->first();

    $imagePath = $existing->service_image;
    if ($request->hasFile('service_image')) {
        $imageName = time() . '_image.' . $request->service_image->extension();
        $request->service_image->move(public_path('admin/service'), $imageName);
        $imagePath = "admin/service/{$imageName}";
    }

    $reportPath = $existing->report;
    if ($request->hasFile('report')) {
        $reportName = time() . '_report.' . $request->report->extension();
        $request->report->move(public_path('admin/service'), $reportName);
        $reportPath = "admin/service/{$reportName}";
    }

    $returnData = [];
    $titles = $request->titles ?? [];
    $names = $request->names ?? [];
    foreach ($titles as $index => $title) {
        if (!empty($title) || !empty($names[$index] ?? '')) {
            $returnData[$title] = $names[$index] ?? null;
        }
    }

    DB::table('sub_services')->where('id', $id)->update([
        'service_id'        => $request->service_id,
        'service_name'      => $request->service_name,
        'short_title'       => $request->short_title,
        'quarterly'         => $request->quarterly,
        'half_yearly'       => $request->half_yearly,
        'yearly'            => $request->yearly,
        'bi_yearly'         => $request->bi_yearly,
        'long_description'  => $request->long_description,
        'report'            => $reportPath,
        'service_type'      => $request->service_type,
        'service_feature'   => $request->service_feature,
        'tracksheet'        => $request->tracksheet,
        'service_image'     => $imagePath,
        'return'            => json_encode($returnData),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Sub Service Updated Successfully!',
    ]);
}

    public function Sub_list()
    {
       $data['courses'] = DB::table('sub_services')->orderBy('id', 'desc')->get();
       return view("Admin.SubServices.list",$data);
    }

    public function Special_list()
    {
       $data['courses'] = DB::table('special_service')->orderBy('id', 'desc')->get();
       return view("Admin.specialservices.list",$data);
    }

        public function SpecialServices()
    {
       return view("Admin.specialservices.add");
    }

public function Special_Services_store(Request $request)
{
    $request->validate([
        'service_image' => 'nullable|image',
        'small_image' => 'nullable|image'
    ]);

    $uploadPath = public_path('admin/service');

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $imagePath = null;
    $smallImagePath = null;

    if ($request->hasFile('service_image')) {
        $imageName = uniqid().'_image.'.$request->service_image->extension();
        $request->service_image->move($uploadPath, $imageName);
        $imagePath = "admin/service/{$imageName}";
    }

    if ($request->hasFile('small_image')) {
        $smallImageName = uniqid().'_small.'.$request->small_image->extension();
        $request->small_image->move($uploadPath, $smallImageName);
        $smallImagePath = "admin/service/{$smallImageName}";
    }

    DB::table('special_service')->insert([
        'service_name' => $request->service_name,
        'service_content' => $request->service_content,
        'service_image' => $imagePath,
        'small_image' => $smallImagePath
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Special Service Added successfully!',
        'redirect' => route('Special_list')
    ]);
}

public function Special_Services_update(Request $request)
{
    $request->validate([
        'id' => 'required|exists:special_service,id',
        'service_name' => 'required|string|max:255',
        'service_content' => 'nullable|string',
        'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $service = DB::table('special_service')->where('id', $request->id)->first();

    $imagePath = $service->service_image; // Keep the old image if not replaced
    $smallimagePath = $service->small_image; // Keep the old image if not replaced


    if ($request->hasFile('service_image')) {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $imageName = time() . '_image.' . $request->service_image->extension();
        $request->service_image->move(public_path('admin/service'), $imageName);
        $imagePath = "admin/service/{$imageName}";
    }
     if ($request->hasFile('small_image')) {
        if ($smallimagePath && file_exists(public_path($smallimagePath))) {
            unlink(public_path($smallimagePath));
        }

        $imageName = time() . '_image.' . $request->small_image->extension();
        $request->small_image->move(public_path('admin/service'), $imageName);
        $smallimagePath = "admin/service/{$imageName}";
    }

    DB::table('special_service')
        ->where('id', $request->id)
        ->update([
            'service_name' => $request->service_name,
            'service_content' => $request->service_content,
            'service_image' => $imagePath,
            'small_image' => $smallimagePath,

        ]);

    return response()->json([
        'success' => true,
        'message' => 'Special Service updated successfully!',
        'redirect' => route('Special_list'),
    ]);
}

    public function Our_tips()
    {
       $data['topPicks'] = DB::table('our_top_picks')->orderBy('id', 'desc')->get();
       return view("Admin.our_tips.list",$data);
    }

    public function Our_tips_store(Request $request)
{
    $data = [
        'PRODUCT' => $request->comex,
        'TRADE' => $request->gold,
        'POSITION' => $request->short,
        'ENTRY PRICE' => $request->value,
        'DURATION' => $request->duration,
        'PROFIT' => $request->points,
    ];

    $jsonData = json_encode($data);

    if ($request->id) {
        // Update using DB query
        DB::table('our_top_picks')->where('id', $request->id)->update([
            'json_table' => $jsonData,
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Top Pick updated successfully.']);
    } else {
        // Insert using DB query
        DB::table('our_top_picks')->insert([
            'json_table' => $jsonData,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Top Pick added successfully.']);
    }
}

public function Events_store(Request $request)
{
    $request->validate([
        'event_name' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date'
    ]);

    $bannerPath = null;

    if ($request->hasFile('banner_image')) {
        $bannerName = time().'_banner.'.$request->banner_image->extension();
        $request->banner_image->move(public_path('admin/events'), $bannerName);
        $bannerPath = "admin/events/{$bannerName}";
    }

    DB::table('events')->insert([
        'event_name' => $request->event_name,
        'slug' => $request->slug,
        'banner_image' => $bannerPath,
        'description' => $request->description,
        'location' => $request->location,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'registration_last_date' => $request->registration_last_date,
        'volunteer_required' => $request->volunteer_required,
        'status' => $request->status,
        'featured' => $request->featured,
        'created_at' => now()
    ]);

    return response()->json([
        'success'=>true,
        'message'=>"Event created successfully",
        'redirect'=>route('events_list')
    ]);
}

public function Events_update(Request $request)
{
    $bannerPath = null;

    if ($request->hasFile('banner_image')) {
        $bannerName = time().'_banner.'.$request->banner_image->extension();
        $request->banner_image->move(public_path('admin/events'), $bannerName);
        $bannerPath = "admin/events/".$bannerName;
    }

    $updateData = [
        'event_name' => $request->event_name,
        'slug' => $request->slug,
        'location' => $request->location,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'registration_last_date' => $request->registration_last_date,
        'volunteer_required' => $request->volunteer_required,
        'status' => $request->status,
        'featured' => $request->featured,
        'updated_at' => now()
    ];

    if($bannerPath){
        $updateData['banner_image'] = $bannerPath;
    }

    DB::table('events')->where('id',$request->id)->update($updateData);

    return response()->json(['success'=>true]);
}

public function Hotel_store(Request $request)
{
    $request->validate([
        'hotel_type'       => 'required',
        'hotel_name'       => 'required|string|max:255',
        'price_per_night'  => 'required|numeric',
        'capacity'         => 'required|integer',
        'hotel_image'      => 'required|image|mimes:jpg,jpeg,png,webp'
    ]);

    $imagePath = null;

    if ($request->hasFile('hotel_image')) {

        $imageName = time().'_hotel.'.$request->hotel_image->extension();

        $request->hotel_image->move(
            public_path('admin/hotels'),
            $imageName
        );

        $imagePath = "admin/hotels/".$imageName;
    }

    DB::table('hotels')->insert([

        'hotel_type'       => $request->hotel_type,
        'hotel_name'       => $request->hotel_name,
        'slug'             => Str::slug($request->hotel_name).'-'.time(),
        'price_per_night'  => $request->price_per_night,
        'capacity'         => $request->capacity,
        'amenities'        => $request->amenities,
        'description'      => $request->description,
        'hotel_image'      => $imagePath,
        'status'           => 1,
        'created_at'       => now(),
        'updated_at'       => now()

    ]);

    return response()->json([
        'success'  => true,
        'message'  => 'Hotel Added Successfully!',
        'redirect' => route('Hotel_list')
    ]);
}

  public function Hotel_list()
    {
       $data['hotels'] = DB::table('hotels')->orderBy('id', 'desc')->get();
       return view("Admin.hotel.list",$data);
    }

public function Hotel_update(Request $request)
{
    $hotel = DB::table('hotels')->where('id',$request->id)->first();

    $imagePath = $hotel->hotel_image;

    if($request->hasFile('hotel_image')){

        $imageName = time().'_hotel.'.$request->hotel_image->extension();
        $request->hotel_image->move(public_path('admin/hotels'), $imageName);
        $imagePath = "admin/hotels/".$imageName;
    }

    DB::table('hotels')->where('id',$request->id)->update([
        'hotel_type' => $request->hotel_type,
        'hotel_name' => $request->hotel_name,
        'price_per_night' => $request->price_per_night,
        'capacity' => $request->capacity,
        'amenities' => $request->amenities,
        'description' => $request->description,
        'hotel_image' => $imagePath,
        'updated_at' => now()
    ]);

    return response()->json(['success'=>true]);
}

public function toggleStatus(Request $request)
{
    try {
        $id = $request->id;

        $item = DB::table('gallery')->where('id', $id)->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }

        // 🔄 Toggle status
        $newStatus = $item->status == 0 ? 1 : 0;

        DB::table('gallery')
            ->where('id', $id)
            ->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'status' => $newStatus
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong'
        ]);
    }
}
public function deleteGallery(Request $request)
{
    try {
        $id = $request->id;

        $item = DB::table('gallery')->where('id', $id)->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }

        // 🗑️ Delete image file (optional but recommended)
        if ($item->gallery_images && file_exists(public_path($item->gallery_images))) {
            unlink(public_path($item->gallery_images));
        }

        // 🗑️ Delete from DB
        DB::table('gallery')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong'
        ]);
    }
}
  public function volentree()
    {
        $data['volunteers'] = DB::table('volunteers')->first();
       return view("Admin.volunteers.add", $data);
    }
  public function objectivesForm()
    {
       return view("Admin.objective.add");
    }
public function objectivesStore(Request $request)
{
    try {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $path = public_path('uploads/objectives');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // ✅ Image upload
        $image = $request->file('image');
        $imageName = time().'_'.uniqid().'.'.$image->extension();
        $image->move($path, $imageName);

        // ✅ Insert data
        DB::table('objectives')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'uploads/objectives/'.$imageName,
            'status' => 0, // 👈 ACTIVE DEFAULT
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Objective added successfully',
            'redirect' => route('objectives.list')
        ]);

    } catch (\Exception $e) {

        // ✅ DEBUG ERROR (IMPORTANT)
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}
public function objectivesUpdate(Request $request)
{
    try {

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => now()
        ];

        // IMAGE UPDATE (optional)
        if ($request->hasFile('image')) {

            $path = public_path('uploads/objectives');

            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();
            $image->move($path, $imageName);

            $data['image'] = 'uploads/objectives/'.$imageName;
        }

        DB::table('objectives')
            ->where('id', $request->id)
            ->update($data);

        return response()->json([
            'success' => true
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}
public function objectivesList()
{
    $data['objectives'] = DB::table('objectives')
        ->orderBy('id', 'desc')
        ->get();

    return view('Admin.objective.list', $data);
}

public function volunteersList()
{
    $data['volunteers'] = DB::table('volunteers')
        ->leftJoin('events', 'events.id', '=', 'volunteers.event_id')
        ->select(
            'volunteers.*',
            'events.event_name'
        )
        ->orderBy('volunteers.id', 'desc')
        ->get();

    return view('Admin.volunteers.list', $data);
}

public function deleteObjective($id)
{
    try {

        $item = DB::table('objectives')->where('id', $id)->first();

        if (!$item) {
            return response()->json(['success' => false]);
        }

        // image delete
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        DB::table('objectives')->where('id', $id)->delete();

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        return response()->json(['success' => false]);
    }
}

public function Topbanner()
{
    $data['top'] = DB::table('top_banner')->first();

    return view('Admin.topbanner', $data);
}

public function updateTopBanner(Request $request)
{
    $fields = ['about_us', 'donate', 'voluntree', 'events', 'bhakt_nivas', 'contact_us'];

    $updateData = [];

    foreach ($fields as $field) {

        if ($request->hasFile($field)) {

            $file = $request->file($field);

            if ($file->isValid()) {

                $imageName = time().'_'.$field.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/logo'), $imageName);

                $updateData[$field] = "admin/logo/".$imageName;
            }
        }
    }

  
    if (DB::table('top_banner')->count() == 0) {

        DB::table('top_banner')->insert($updateData);

    } else {

        
        DB::table('top_banner')->update($updateData);
    }

    return response()->json([
        'success' => true,
        'message' => 'Top Banner Updated Successfully!',
        'data' => $updateData
    ]);
}
}

