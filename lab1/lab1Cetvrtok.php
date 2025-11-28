<?php
enum Specialization: string {
    case FAMILY_MEDICINE = "Family Medicine";
    case CARDIOLOGY = "Cardiology";
    case NEUROLOGY = "Neurology";
    case RADIOLOGY = "Radiology";
}
class Patient {
    public int $id;
    public string $name;
    private array $medicalHistory = [];
    private array $treatmentHistory = [];

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function addDiagnosis(string $diagnosis): void {
        $this->medicalHistory[] = $diagnosis;
    }

    public function addTreatment(string $treatment): void {
        $this->treatmentHistory[] = $treatment;
    }

    public function getMedicalHistory(): array {
        return $this->medicalHistory;
    }

    public function getTreatmentHistory(): array {
        return $this->treatmentHistory;
    }
}
trait Treatable {
    public function diagnose(Patient $patient, string $diagnosis): void {
        $patient->addDiagnosis($diagnosis);
        echo "Diagnosed {$patient->name} with: {$diagnosis}\n";
    }
}
abstract class Doctor {
    public string $id;
    public string $name;
    public Specialization $specialization;
    public int $yearsExperience;
    protected array $patients = []; // асоцијативна низа (id => Patient)

    public function __construct(string $id, string $name, Specialization $specialization, int $yearsExperience) {
        $this->id = $id;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->yearsExperience = $yearsExperience;
    }
    public function addPatient(Patient $patient): void {
        if (!isset($this->patients[$patient->id])) {
            $this->patients[$patient->id] = $patient;
            echo "Added patient {$patient->name} to Dr. {$this->name}\n";
        } else {
            echo "Patient {$patient->name} already exists for Dr. {$this->name}\n";
        }
    }
    public function printPatients(): void {
        echo "\nDoctor {$this->name} ({$this->specialization->value}) patients:\n";
        if (empty($this->patients)) {
            echo "No patients.\n";
        } else {
            foreach ($this->patients as $patient) {
                echo "- {$patient->name} (ID: {$patient->id})\n";
            }
        }
    }
}
class FamilyDoctor extends Doctor {
    use Treatable;

    public function __construct(string $id, string $name, int $yearsExperience) {
        parent::__construct($id, $name, Specialization::FAMILY_MEDICINE, $yearsExperience);
    }
    public function refer(Patient $patient, array $doctors, Specialization $specialization): ?Doctor {
        // најди го специјалистот со најмногу искуство
        $eligibleDoctors = array_filter($doctors, fn($d) => $d->specialization === $specialization);

        if (empty($eligibleDoctors)) {
            echo "No specialist with specialization {$specialization->value} found.\n";
            return null;
        }

        usort($eligibleDoctors, fn($a, $b) => $b->yearsExperience <=> $a->yearsExperience);
        $chosenDoctor = $eligibleDoctors[0];

        if (isset($chosenDoctor->patients[$patient->id])) {
            echo "Patient {$patient->name} is already referred to Dr. {$chosenDoctor->name}\n";
            return $chosenDoctor;
        }

        $chosenDoctor->addPatient($patient);
        echo "Referred {$patient->name} to Dr. {$chosenDoctor->name}\n";
        return $chosenDoctor;
    }
}
class Specialist extends Doctor {
    public function __construct(string $id, string $name, int $yearsExperience, Specialization $specialization) {
        parent::__construct($id, $name, $specialization, $yearsExperience);
    }
    public function treatPatient(Patient $patient, string $treatment): void {
        if (isset($this->patients[$patient->id])) {
            $patient->addTreatment($treatment);
            unset($this->patients[$patient->id]);
            echo "Treated {$patient->name} with: {$treatment}\n";
        } else {
            echo "Patient {$patient->name} not found under Dr. {$this->name}\n";
        }
    }
}
// Create patients
$john = new Patient(1, "John Doe");
$jane = new Patient(2, "Jane Smith");

// Create doctors
$familyDoctor = new FamilyDoctor("D001", "Dr. Brown", 12);
$cardiologist1 = new Specialist("D002", "Dr. Heart", 8, Specialization::CARDIOLOGY);
$cardiologist2 = new Specialist("D003", "Dr. Pulse", 15, Specialization::CARDIOLOGY);
$neurologist = new Specialist("D004", "Dr. Brain", 10, Specialization::NEUROLOGY);

// Add patient to family doctor
$familyDoctor->addPatient($john);
$familyDoctor->diagnose($john, 'High blood pressure');
// Print before referral
$familyDoctor->printPatients();

// Refer John to cardiologist (most experienced one)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);
echo "Referred patient with id $john->id to doctor $treatingDoctor->name\n";

// Refer the same patient again (should return that patient is already referred)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);

$treatingDoctor->printPatients();

if ($treatingDoctor instanceof Specialist) {
    $treatingDoctor->treatPatient($john, 'Beta-blockers');
}

// Print specialists’ patients after referral
$treatingDoctor->printPatients();

// Show John’s medical history
echo "\nMedical history of {$john->name}:\n";
foreach ($john->getMedicalHistory() as $record) {
    echo "- $record\n";
}