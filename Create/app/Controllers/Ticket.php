
<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TechnicianModel;

class Ticket extends BaseController
{
    public function create()
    {
        $ticketModel = new TicketModel();
        $techModel = new TechnicianModel();

        $data = [
            'technicians' => $techModel
                ->where('is_active', 1)
                ->findAll(),

            'tickets' => $ticketModel->findAll()
        ];

        return view('tickets/create', $data);
    }

    public function store()
    {
        $ticketModel = new TicketModel();

        $rules = [
            'reporter_name' => 'required|max_length[100]',
            'issue_title' => 'required|max_length[150]',
            'priority' => 'required|in_list[Low,Medium,High,Critical]',
            'assigned_tech_id' => 'permit_empty|integer',
            'parent_ticket_id' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $techModel = new TechnicianModel();

        $techID = $this->request->getPost('assigned_tech_id');
        $parentID = $this->request->getPost('parent_ticket_id');

        // Validate selected technician
        if (!empty($techID)) {
            $technician = $techModel
                ->where('is_active', 1)
                ->find($techID);

            if (!$technician) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid technician selected.');
            }
        }

        // Validate parent ticket
        if (!empty($parentID)) {
            $parentTicket = $ticketModel->find($parentID);

            if (!$parentTicket) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Parent ticket does not exist.');
            }
        }

        $db = \Config\Database::connect();

        $db->transStart();

        // Temporary unique ticket code
        $temporaryCode = 'TEMP-' . bin2hex(random_bytes(8));

        $ticketID = $ticketModel->insert([
            'ticket_code' => $temporaryCode,
            'reporter_name' => $this->request->getPost('reporter_name'),
            'issue_title' => $this->request->getPost('issue_title'),
            'priority' => $this->request->getPost('priority'),
            'status' => 'Open',
            'assigned_tech_id' => !empty($techID) ? $techID : null,
            'parent_ticket_id' => !empty($parentID) ? $parentID : null
        ]);

        if ($ticketID) {
            // Generate final ticket code
            $ticketCode = 'TKT-' . date('Y') . '-'
                . str_pad($ticketID, 3, '0', STR_PAD_LEFT);

            $ticketModel->update($ticketID, [
                'ticket_code' => $ticketCode
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false || !$ticketID) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create ticket.');
        }

        return redirect()->to('/tickets/create')
            ->with('success', 'Ticket created successfully! Code: ' . $ticketCode);
    }
}