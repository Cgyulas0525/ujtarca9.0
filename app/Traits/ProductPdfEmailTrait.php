<?php
namespace  App\Traits;

use App\Events\SendMail;
use App\Models\Partners;
use App\Actions\ProductPdfAction;
use Event;

trait ProductPdfEmailTrait {

    public function pdfEmail() {

        $owner = Partners::where('partnertypes_id', 5)->first();
        $partners = Partners::where('partnertypes_id', 3)->get();
        $productPdfAction = new ProductPdfAction($owner, $partners);

        foreach ($partners as $partner) {

            $path = $productPdfAction->handle();
            Event::dispatch(new SendMail($partner, $owner, $path, 'emails.pekaruMail','pékáru lista!', 'új pékáru listát küldött Önnek.'));

        }

        return back();
    }

}
