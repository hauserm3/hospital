/**
 * Created by админ on 23.09.2016.
 */
import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {Subject} from "rxjs/Rx";


@Injectable()

export class RoomsService{

    private selectedItem:VOIpRoom;
    private selectedItemSubject = new Subject<VOIpRoom>();
    selectedItem$:Observable<VOIpRoom> = this.selectedItemSubject.asObservable();

    private selectedICon:VOIcon;
    private selectedIconSubject = new Subject<VOIcon>();
    selectedIcon$:Observable<VOIcon> = this.selectedIconSubject.asObservable();

    constructor(private http:Http){}

    getRooms():Observable<VOIp_Rooms>{
        return this.http.get('server/save_rooms.php').map((res:any)=>{
            // console.log('res', res);
            return new VOIp_Rooms(res.json());
        });
    }

    getRoom():Observable<VORoom>{
        return this.http.get('server/get-my-room.php?room_id='+1).map((res:any)=>{
            // console.log('res', res);
            return new VORoom(res.json());
        });
    }

    getIcons():Observable<VOIcons>{
        return this.http.get('server/get_icons.php').map((res:any)=>{
            return new VOIcons(res.json());
        });
    }

    saveRooms(data:VOIp_Rooms):Observable<VOResult>{
        return this.http.post('server/save_rooms.php',data).map((res:any)=>{
            return new VOResult(res.json());
        });
    }

    saveIcons(icons:VOIcons):Observable<VOResult>{
        return this.http.post('server/save_icons.php',icons).map((res:any)=>{
            return new VOResult(res.json());
        });
    }

    deleteRoom(data:VOIpRoom):Observable<VOResult>{
        delete data.selected;
        return this.http.post('server/delete_room.php',data).map((res:any)=>{
            return new VOResult(res.json());
        });
    }

    deleteIcon(icon:VOIcon):Observable<VOResult>{
        delete icon.selected;
        return this.http.post('server/delete_icon.php',icon).map((res:any)=>{
            return new VOResult(res.json());
        });
    }


    selectItem(item:VOIpRoom){
        if (this.selectedItem) this.selectedItem.selected = false;
        this.selectedItem = item;
        this.selectedItem.selected = true;
        this.selectedItemSubject.next(item);
        // console.log('selectItem ', this.selectedItem);
    }

    selectIcon(item:VOIcon){
        if (this.selectedICon) this.selectedICon.selected = false;
        this.selectedICon = item;
        this.selectedICon.selected = true;
        this.selectedIconSubject.next(item);
        // console.log('selectItem ', this.selectedICon);
    }
}

export class VOIpRoom {
    IP: string;
    ID: number;
    selected: boolean;

    constructor (obj:any) {
        for (var str in obj)this[str] = obj[str];
    }
}

export class VOIp_Rooms {
    vers: number;
    rooms:VOIpRoom[];

    constructor (obj:any) {
        for (var str in obj)this[str] = obj[str];
        // console.log(this.rooms);
        if(this.rooms) this.rooms = this.rooms.map(function (item) {
            return new VOIpRoom(item);
        });
    }
}

export class VOIcon{
    label: string;
    filename: string;
    iconPath: string;
    selected: boolean;

    constructor (obj:any) {
        for (var str in obj)this[str] = obj[str];
        this.iconPath=this.iconPath+ "?" + Date.now();//getTime();
    }
}

export class VOIcons{
    icons: VOIcon[];

    constructor (obj:VOIcon[]) {
        for (var str in obj)this[str] = obj[str];
        // console.log(this.rooms);
        if(this.icons) this.icons = this.icons.map(function (item) {
            return new VOIcon(item);
        });
        // this.icons = obj.map(function (item) {
        //     return new VOIcon(item);
        // });
    }
}

export class VORoom {
    IP: string;
    ID: number;
    BedName: string;
    Patientname: string;
    FallRisk: string;
    FallRisk_f: string;
    FallRisk_i: string;
    AllergyMed: string;
    AllergyMed_f: string;
    AllergyMed_i: string;
    AllergyLatex: string;
    AllergyLatex_f: string;
    AllergyLatex_i: string;
    AllergyFood: string;
    AllergyFood_f: string;
    AllergyFood_i: string;
    AllergySubstance: string;
    AllergySubstance_f: string;
    AllergySubstance_i: string;
    HazardousMed: string;
    HazardousMed_f: string;
    HazardousMed_i: string;
    InfectionControl: string;
    InfectionControl_f: string;
    InfectionControl_i: string;

    constructor (obj:any) {
        for (var str in obj) this[str] = obj[str];
    }
}

export class VORoom2 {
    IP: string;
    ID: number;
    BedName: string;
    FallRisk: string;
    HazardousMed: string;
    InfectionControl: any;
    Precautions: any;

    constructor (obj:any) {
        for (var str in obj) this[str] = obj[str];
    }

}

export class VOResult {
    success: string;
    error: string;
    result: any;

    constructor(obj: any) {
        for (var str in obj)this[str] = obj[str];
    }
}