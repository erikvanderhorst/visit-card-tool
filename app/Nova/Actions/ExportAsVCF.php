<?php

namespace App\Nova\Actions;

use http\Client\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCard;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExportAsVCF extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $employee = $models[0];
        $company = $employee->company;
        $imagePath = Storage::disk('public')->path('b6oJ6JRN8ljjxrYyMKjImV5MBrnBeubJ3V32Pyg7.jpg');
        $vcard = new VCard();

// define variables
        $lastname = $employee->first_name;
        $firstname = $employee->last_name;

// add personal data
        $vcard->addName($lastname, $firstname);

// add work data
        $vcard->addCompany($company->name);
        $vcard->addJobtitle($employee->function);
        $vcard->addEmail($employee->email);
        $vcard->addPhoneNumber($employee->phone, 'WORK');
        $vcard->addAddress(null, null, $company->address . ' ' . $company->house_number, $company->city, null, $company->zipcode, 'Nederland');
        $vcard->addLabel($company->address . ' ' . $company->house_number . ' ' . $company->zipcode . ' ' . $company->city);
        $vcard->addPhoto($imagePath);
        $vcard->setSavePath(Storage::path('/public'));
        return response()->download(storage_path('app\public'));


    }

    /**
     * Get the fields available on the action.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
