<?php

namespace App\Imports;

use DB;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProjectHierarchyImport implements ToCollection
{
    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {

            $locationId = null;
            $milestoneId = null;

            foreach ($rows as $index => $row) {

                // Skip header row
                if ($index == 0) continue;

                $type = strtoupper(trim($row[0] ?? ''));
                $location = trim($row[1] ?? '');
                $milestone = trim($row[2] ?? '');
                $task = trim($row[3] ?? '');

                switch ($type) {

                    case 'L':

                        if (empty($location)) {
                            throw new Exception("Row " . ($index+1) . ": Location required");
                        }

                        $locationId = DB::table('pscope')->insertGetId([
                            'pscope_project_id' => $this->projectId,
                            'pscope_country' => 'India',
                            'pscope_state' => '',
                            'pscope_city' => $location,
                            'pscope_pincode' => '',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        // reset milestone
                        $milestoneId = null;

                        break;


                    case 'M':

                        if (!$locationId) {
                            throw new Exception("Row " . ($index+1) . ": Milestone without Location");
                        }

                        if (empty($milestone)) {
                            throw new Exception("Row " . ($index+1) . ": Milestone required");
                        }

                        $milestoneId = DB::table('pplnr')->insertGetId([
                            'pplnr_milestone' => $milestone,
                            'pplnr_scope_id' => $locationId,
                            'pplnr_start_date' => date('Y-m-d'),
                            'pplnr_end_date' => date('Y-m-d'),
                            'pplnr_status' => 'pending',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        break;


                    case 'T':

                        if (!$milestoneId) {
                            throw new Exception("Row " . ($index+1) . ": Task without Milestone");
                        }

                        if (empty($task)) {
                            throw new Exception("Row " . ($index+1) . ": Task required");
                        }

                        DB::table('pptasks')->insert([
                            'pptasks_task_title' => $task,
                            'pptasks_planner_id' => $milestoneId,
                            'pptasks_start_date' => date('Y-m-d'),
                            'pptasks_end_date' => date('Y-m-d'),
                            'pptasks_pt_status' => 'pending',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        break;


                    default:
                        throw new Exception("Row " . ($index+1) . ": Invalid Type (use L, M, T)");
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
