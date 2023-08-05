<?php

namespace App\Http\Controllers\Backend;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Support\Facades\Artisan;

class GeneralSettingsController extends Controller
{
     //site settings view return
     public function siteView(){
        $pageTitle = 'Site Settings';
        return view('backend.pages.settings.site' , compact('pageTitle'));
    }

    // Site Settings Store
    public function siteStore(Request $request){

        $request -> validate([
            'site_name' => 'max:50',
            'site_tagline' => 'max:100',
            'site_email' => 'nullable|email',
            'site_address' => 'required|max:255',
            'site_phone' => 'required|max:100',
            'site_logo' => 'nullable|mimes:png,jpg',
            'site_favicon' => 'nullable|mimes:png,jpg',

        ]);

        $site = Settings::findOrFail(1);
        $site_logo = uploadSingleImg($request -> site_logo, '/backend/uploads/site' , $site -> logo, NULL );
        $site_favicon = uploadSingleImg($request -> site_favicon, '/backend/uploads/site' , $site -> favicon,NULL );

        $content = [];
        $content = [
            'fb_link' => $request -> fb_link,
            'youtube_link' => $request -> youtube_link,
            'twitter_link' => $request -> twitter_link,
            'rss_link' => $request -> rss_link
        ];

        Settings::updateOrCreate(['id' => 1],[
            'site_title' => $request -> site_name,
            'site_tagline' => $request -> site_tagline,
            'site_email' => $request -> site_email,
            'poribar' => $request -> poribar,
            'site_phone' => $request -> site_phone,
            'site_address' => $request -> site_address,
            'logo' => $site_logo,
            'favicon' => $site_favicon,
            'social_links' => $content,

        ]);

        return redirect() -> back() -> with('success' , 'General Settings Update');


    }

    //site settings view return
    public function emailView(){
        $pageTitle = 'Email Settings';
        return view('backend.pages.settings.email' , compact('pageTitle'));
    }

    // Site Settings Store
    public function emailStore(Request $request){

        $request -> validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'encryption' => 'required',
            'user_name' => 'required',
            'password' => 'required',
        ]);


        $content = [];

        $content = [
            'smtp_host' => $request -> smtp_host,
            'smtp_port' => $request -> smtp_port,
            'encryption' => $request -> encryption,
            'user_name' => $request -> user_name,
            'password' => $request -> password,
        ];

        Settings::updateOrCreate(['id' => 1],[
            'email_method' => $content,
        ]);

        return redirect() -> back() -> with('success' , 'Email Settings Update');


    }


    //site settings view return
    public function seoView(){
        $pageTitle = 'SEO Settings';
        return view('backend.pages.settings.seo' , compact('pageTitle'));
    }

    // Site Settings Store
    public function seoStore(Request $request){

        $request -> validate([
            'seo_title' => 'required',
            'seo_des' => 'required',
            'seo_keywords' => 'required',
        ]);


        $content = [];

        $content = [
            'seo_title' => $request -> seo_title,
            'seo_des' => $request -> seo_des,
            'seo_keywords' => $request -> seo_keywords,
        ];

        Settings::updateOrCreate(['id' => 1],[
            'site_seo_des' => $content,
        ]);

        return redirect() -> back() -> with('success' , 'SEO Settings Update');


    }

    public function our_backup_database()
    {
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();

        $output = '';
        foreach ($result as $table) {

            $show_table_query = "SHOW CREATE TABLE " . $table[0] . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach ($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table[0] . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);

                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table[0] (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }


    public function cache(){

        try {
            Artisan::call('optimize:clear');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('view:cache');
            return redirect() -> back() -> with('success' , 'Clear Cache Successfully');


        } catch (\Throwable $th) {
            return redirect() -> back() -> with('error' , $th);
        }


    }

    public function signatureindex(){
        $pageTitle = 'Signature';
        $general = Site::find(1);
        return view('backend.pages.signature' , compact('pageTitle' , 'general'));
    }

    //signature update
    public function signaturestore(Request $request){
        $site = Site::find(1);
        $signature = uploadSingleImg($request -> signature, '/backend/uploads/site/' , $site -> signature , NULL );
        Site::updateOrCreate(['id' => 1],[
            'signature' => $signature,
        ]);

        return redirect() -> back() -> with('success' , 'Signature Update');




    }



}
