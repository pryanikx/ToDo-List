<?php

enum Status: string {
    case AWAITING = 'Awaiting';
    case COMPLETED = 'Completed';
    case COMPLETED_AFTER_DEADLINE = 'Completed after deadline';
}