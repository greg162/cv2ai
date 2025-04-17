
import { Check } from '@/features/checks/Check';


export class ResumeScanner extends Check {
    id: string;
    name: string;

    constructor() {
        super();
        this.id = 'resume_scanner';
        this.name = 'Resume Scanner';
    }


}