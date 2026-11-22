<?php

namespace App\Controllers; 

use App\Models\TicketModel;

class TicketController extends BaseController
{
    // DISPLAY ACTIVE TICKETS
    public function index()
    {
        $model = new TicketModel();

        $data['tickets'] = $model->findAll();

        return view('tickets/index', $data);
    }

    
    public function delete($id)
    {
        $model = new TicketModel();

        $ticket = $model->find($id);

        if (!$ticket) {
            return redirect()->to('/tickets')
                ->with('error', 'Ticket not found!');
        }

        $model->delete($id);

        return redirect()->to('/tickets')
            ->with('success', 'Ticket successfully archived!');
    }


    public function archive()
    {
        $model = new TicketModel();

        $data['tickets'] = $model->onlyDeleted()->findAll();

        return view('tickets/archive', $data);
    }

    
    public function restore($id)
    {
        $model = new TicketModel();

        $ticket = $model->onlyDeleted()->find($id);

        if (!$ticket) {
            return redirect()->to('/tickets/archive')
                ->with('error', 'Archived ticket not found!');
        }

        $model->update($id, ['deleted_at' => null]);

        return redirect()->to('/tickets')
            ->with('success', 'Ticket successfully restored!');
    }

    
    public function forceDelete($id)
    {
        $model = new TicketModel();

        $ticket = $model->onlyDeleted()->find($id);

        if (!$ticket) {
            return redirect()->to('/tickets/archive')
                ->with('error', 'Archived ticket not found!');
        }

        $model->delete($id, true);

        return redirect()->to('/tickets/archive')
            ->with('success', 'Ticket permanently deleted!');
    }
}