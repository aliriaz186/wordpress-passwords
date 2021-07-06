<?php

namespace App\Http\Controllers;

use App\CodeView;
use App\Entry;
use App\Liked;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Session::get('userId');
        $user = User::where('id', $userId)->first();
        $entries = Entry::all();
        $tempEntries = [];
        foreach($entries as $item){
            $item->views = CodeView::where('entry_id', $item->id)->count();
            if((int)$item->views > 0){
                array_push($tempEntries, $item);
            }
        }
        return view('dashboard.home')->with(['user' => $user, 'tempEntries' => $tempEntries]);
    }

    public function showUploadNewEntryPage()
    {
        return view('dashboard.upload-new-entry');
    }

    public function downloadCertificateFile($certificateId, $fileId){
        // $file = CertificateFiles::where('id', $fileId)->first();
        // $certificate = Certificates::where('id', $certificateId)->first();
        // $user = User::where('id', $certificate->user_id)->first();
        // $file =  base_path('/data') . '/Certificate-Files-' . $user->id . '/' . $file->file_name;
        // $type = mime_content_type($file);
        // header('Content-Type:' . $type);
        // header('Content-Length: ' . filesize($file));
        // return readfile($file);
    }

    public function showImage($fileId){
        $fileN = Entry::where('id', $fileId)->first()['logo'];
        $file =  base_path('/data') . '/files' . '/' . $fileN;
        $type = mime_content_type($file);
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        // header('Content-Disposition: attachment; filename="Logo.png"');
        return readfile($file);
    }

    public function deleteEntry($id){
        try {

           $entry = Entry::where('id', $id)->delete();
          session()->flash('msg', 'Entry Deleted Successfully.');
          return redirect()->back();

      }catch (\Exception $exception){
          return redirect()->back()->withErrors([$exception->getMessage()]);

      }

    }

    public function entries(){
        // $entries = Entry::all();
        // foreach($entries as $item){
        //     $item->views = CodeView::where('entry_id', $item->id)->distinct('useragent', 'ip')->count();
        // }

        $categories = Entry::select('product_type')->distinct()->get();
        $influencers = Entry::select('influencer')->distinct()->get();
        $products = Entry::select('product')->distinct()->get();
        return view('dashboard.entries')->with(['categories' => $categories, 'influencers' => $influencers, 'products' => $products]);
    }

    public function savingNewEntry(Request $request)
    {
        try {

              $entry = new Entry();
              $entry->influencer = $request->influencer;
              $entry->product = $request->productName;
              $entry->product_type = $request->productType;
              $entry->promo_code = $request->promoCode;
              $entry->info = $request->info;

            if ($request->hasfile('fileOne')) {
                $files = $request->file('fileOne');
                foreach ($files as $file) {
                    $name = rand(0, 1000) .time() . '.' . $file->getClientOriginalExtension();
                    $file->move(base_path('/data') . '/files/', $name);
                    $entry->logo = $name;
                }
            } else {
                return redirect()->back()->withErrors(['Atleast one File should be uploaded!']);
            }
            $entry->save();
            session()->flash('msg', 'Entry Added Successfully.');
            return redirect()->back();

        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);

        }

    }

    public function updateEntry(Request $request)
    {
        try {

            $entry = Entry::where('id', $request->entry_id)->first();
            $entry->influencer = $request->influencer;
            $entry->product = $request->productName;
            $entry->product_type = $request->productType;
            $entry->promo_code = $request->promoCode;
            $entry->info = $request->info;

            if ($request->hasfile('fileOne')) {
                if(File::exists(base_path('/data') . '/files/' . $entry->logo)){
                    File::delete(base_path('/data') . '/files/' . $entry->logo);
                }
                $files = $request->file('fileOne');
                foreach ($files as $file) {
                    $name = rand(0, 1000) .time() . '.' . $file->getClientOriginalExtension();
                    $file->move(base_path('/data') . '/files/', $name);
                    $entry->logo = $name;
                }
            }
            $entry->update();
            session()->flash('msg', 'Entry Updated Successfully.');
            return redirect()->back();

        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);

        }

    }

    public function editEntry($id){
        $entry = Entry::where('id', $id)->first();
        return view('dashboard.edit-entry')->with(['entry' => $entry]);
    }

    public function profile(){
        return view('dashboard.profile');
    }

    public function saveProfileInfo(Request $request){
        try {
            if(User::where('password', $request->oldpassword)->exists()){
                if(empty($request->newpassword)){
                    return redirect()->back()->withErrors(["New Password is required"]);
                }
                if(empty($request->confirmnewpassword)){
                    return redirect()->back()->withErrors(["Confirm New Password is required"]);
                }
                if($request->newpassword != $request->confirmnewpassword){
                    return redirect()->back()->withErrors(["Password Mismatch"]);
                }
                $admin = User::where('email', 'admin')->first();
                $admin->password = $request->newpassword;
                $admin->update();
                session()->flash('msg', 'Password Changes Successfully.');
                return redirect()->back();
            }else{
                return redirect()->back()->withErrors(["Old Password not matched"]);
            }

        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);

        }
    }

    public function searchEntries(Request $request){

        $sortInfluencer = $request->sort_influencer;
        $sortProduct = $request->sort_product;
        $sortType = $request->sort_type;

        $entries = Entry::where('id', '!=', 0);
        $limit = $request->input('length');
       if(!empty($request->category)){
        $category = $request->category;
        $entries->where('product_type', 'LIKE', "%{$category}%");
       }
       if(!empty($request->influencer)){
        $influencer = $request->influencer;
        $entries->where('influencer', 'LIKE', "%{$influencer}%");
       }
       if(!empty($request->product)){
        $product = $request->product;
        $entries->where('product', 'LIKE', "%{$product}%");
       }

       //sorting
       if($sortInfluencer == 1){
         $entries = $entries->orderBy('influencer', 'ASC')->limit($limit)->get();
       }
       else if($sortProduct == 1){
        $entries = $entries->orderBy('product', 'ASC')->limit($limit)->get();
       }
       else if($sortType == 1){
        $entries = $entries->orderBy('product_type', 'ASC')->limit($limit)->get();
       }else if($request->sort_ascending == 0){
        $entries = $entries->limit($limit)->get();
       }else if($request->sort_ascending == 1){
        $entries = $entries->orderBy('id', 'DESC')->limit($limit)->get();
       }else{
        $entries = $entries->limit($limit)->get();
       }

       foreach($entries as $item){
           $total = Liked::where('entry_id', $item->id)->count();
           if($total > 0){
            $workedCount = Liked::where('entry_id', $item->id)->where('status', 'liked')->count();
            $workedC = ($workedCount * 100) / $total;

            $unworkedCount = Liked::where('entry_id', $item->id)->where('status', 'unliked')->count();
            $unworkedC = ($unworkedCount * 100) / $total;

            if($workedC > 0){
                $item->worked = round($workedC);
                $item->update();
           }
           if($unworkedC > 0){
                $item->notwordked = round($unworkedC);
                $item->update();
           }
        }

        $item->views = CodeView::where('entry_id', $item->id)->count();

       }
       $entriesCount = Entry::all()->count();
       return json_encode(['status' => true, 'data' => $entries, 'entriesCount' => $entriesCount]);
    }
}
