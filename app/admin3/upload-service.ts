///<reference path="../../typings/jquery.d.ts"/>

import {Injectable} from "@angular/core";
import {Observable} from "rxjs";
import {VOResult} from "../rooms-service";


@Injectable()

export class UploadService{

    upload(form:FormData, fileName:string):JQueryPromise<VOResult>{

        return  $.ajax({
            url: 'api/upload.php?fileName='+fileName,
            type: 'POST',
            dataType: 'json',
            data: form,
            cache: false,
            contentType: false,
            processData: false
        });
    }
}