<?php
// app/Controllers/Tickets.php  (edit + update for the form in tickets/edit.php)
//
// Routes (app/Config/Routes.php):
//   $routes->get('tickets/(:num)/edit', 'Tickets::edit/$1');
//   $routes->put('tickets/(:num)',      'Tickets::update/$1');


namespace App\Controllers;


use App\Models\TicketModel;
use App\Models\TechnicianModel;


class Tickets extends BaseController
{
    public function edit(int $id)
    {
        $tickets = new TicketModel();
        $ticket  = $tickets->find($id);


        if (! $ticket) {
            return redirect()->to('/tickets')->with('error', 'Ticket not found or archived.');
        }


        return view('tickets/edit', [
            'ticket'      => $ticket,
            'technicians' => (new TechnicianModel())->where('is_active', 1)->findAll(),
            'parents'     => $tickets->where('ticket_id !=', $id)->findAll(),
        ]);
    }


    public function update(int $id)
    {
        $tickets = new TicketModel();


        if (! $tickets->find($id)) {
            return redirect()->to('/tickets')->with('error', 'Ticket not found or archived.');
        }


        $parentId = $this->request->getPost('parent_ticket_id') ?: null;
        if ($parentId !== null && $tickets->wouldCreateCycle($id, (int) $parentId)) {
            return redirect()->back()->withInput()->with('error', 'A ticket cannot be its own parent or create a loop.');
        }


        $saved = $tickets->update($id, [
            'issue_title'      => $this->request->getPost('issue_title'),
            'priority'         => $this->request->getPost('priority'),
            'status'           => $this->request->getPost('status'),
            'assigned_tech_id' => $this->request->getPost('assigned_tech_id') ?: null,
            'parent_ticket_id' => $parentId,
        ]);


        if (! $saved) {
            return redirect()->back()->withInput()->with('error', implode(' ', $tickets->errors()));
        }


        return redirect()->to('/tickets')->with('success', 'Ticket updated.');
    }
}
