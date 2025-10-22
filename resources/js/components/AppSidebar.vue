<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import {BookOpen, HandCoins, UserRoundMinus, HeartPulse, CircleDollarSign, BarChart2, Clock, UserCheck, UserX, ClipboardList,
        SquarePlus, IdCard, Wallet, Accessibility, ChartLine, Beaker, DollarSign, FileBarChart, Edit, Siren, Scissors,
        LayoutGrid, Microscope, Trash2, Building2, BarChart, TestTube, HandPlatter, SlidersHorizontal, ListTree, ListCollapse,
        UserCog, CalendarSync, List, Calendar, Hospital, Bed, LogOut, ClipboardCheck, ArrowLeftRight, Pill, FileBadge, Baby, Skull,
        UserPlus, CalendarCheck, BedDouble, FileChartLine, ShoppingCart, Package, Banknote, FileSpreadsheet, Ambulance, PlusCircle,
        Users, BookUser, BarChart3, Boxes, FlaskRound, FilePlus2, ScanLine, Signature, ListCheck, MinusCircle, TrendingDown, FolderPlus,
        FileText, CalendarDays, FolderOpen, ClipboardPen, UsersRound, Calculator, BarChart4, ListOrdered, BadgePercent, UserSquare,
        Settings, ScrollText, Megaphone, Receipt, CalendarRange, Users2, TrendingUp, Stethoscope, ShieldCheck, Component, SquarePen,

    } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    // Dashboard
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    // Test Management
    {
    title: 'Test Manage',
    href: '#', // parent route (optional)
    icon: TestTube,
    // 🧩 Submenu items
    children: [
      {
        title: 'Test/Group List',
        href: '#',
        icon: Component,
      },
      {
        title: 'Additional/Items',
        href: '#',
        icon: ListTree,
      },
      {
        title: 'Specimen List',
        href: '#',
        icon: ListCollapse,
      },
      {
        title: 'Edit Hospital From',
        href: '#',
        icon: SquarePen,
      }
    ],
    },
    // Role Managment
    {
        title: 'Role Management',
        href: '#',
        icon: ShieldCheck,
        children: [
        {
            title: 'Role List',
            href: '/users/role',
            icon: FileText,
        },
        {
            title: 'Permission List',
            href: '/users/permission',
            icon: ClipboardList,
        },
        {
            title: 'Add New User',
            href: '/users/create',
            icon: UserPlus,
        },
        {
            title: 'User List',
            href: '/users',
            icon: ScrollText,
        },
        ],
    },
    // Appointment Management
    {
    title: 'Appointment Manage',
    href: '/reports',
    icon: CalendarDays,
    children: [
      {
        title: 'New Booking',
        href: '/reports/monthly',
        icon: BookUser,
      },
      {
        title: 'Booking List',
        href: '/reports/annual',
        icon: CalendarSync,
      },
      {
        title: 'Add Schedule',
        href: '/reports/annual',
        icon: CalendarCheck,
      },
       {
        title: 'Schedule List',
        href: '/reports/annual',
        icon: ScrollText,
      },
    ],
    },
    // Doctor Management
    {
        title: 'Doctor Manage',
        href: '/reports',
        icon: Stethoscope,
        children: [
        {
            title: 'Add New Doctor',
            href: '/reports/monthly',
            icon: SquarePlus,
        },
        {
            title: 'Doctor List',
            href: '/reports/annual',
            icon: ScrollText,
        },
        {
            title: 'Commission Setup',
            href: '/reports/annual',
            icon: HandCoins,
        },
        {
            title: 'Leave Doctor',
            href: '/reports/annual',
            icon: UserRoundMinus,
        },
        ],
    },
    // UHID Management
    {
        title: 'UHID Manage',
        href: '/reports',
        icon: IdCard,
        children: [
        {
            title: 'Registration',
            href: '/reports/monthly',
            icon: UserPlus,
        },
        {
            title: 'List',
            href: '/reports/annual',
            icon: ListTree,
        },
        {
            title: 'All Examination Report',
            href: '/reports/annual',
            icon: FileText,
        },
        ],
    },
    // Diagnostic Management
    {
        title: 'Diagnostic/OPT',
        href: '/reports',
        icon: HeartPulse,
        children: [
        {
            title: 'Investigation Payment',
            href: '/reports/monthly',
            icon: Wallet,
        },
        {
            title: 'Patient',
            href: '#',
            icon: Accessibility,
            children: [
                { title: 'All Patient List', href: '#' },
                { title: 'Paid Patient List', href: '#' },
                { title: 'Due Patient List', href: '#' },
                { title: 'Due Collection', href: '#' },
            ]
        },
        {
            title: 'Billing List',
            href: '/reports/annual',
            icon: DollarSign,
            children: [
                { title: 'Billing List', href: '#' },
                { title: 'Paid Invoice', href: '#' },
                { title: 'Due Invoice', href: '#' },
            ]
        },
        {
            title: 'Patient Summary',
            href: '#',
            icon: ChartLine,
        },
        {
            title: 'Discount Summary',
            href: '#',
            icon: BarChart2,
        },
        {
            title: 'Group Wish Test Count',
            href: '#',
            icon: Beaker,
        },
        {
            title: 'Commission',
            href: '#',
            icon: CircleDollarSign,
            children: [
                { title: 'Commission List', href: '#' },
                { title: 'Commission Details', href: '#' },
                { title: 'Group Wish Collection', href: '#' },
                { title: 'Group Wish Commission', href: '#' },
                { title: 'Paid / Unpaid List', href: '#' },
            ]
        },
        {
            title: 'Test Refund/Edit Receipt',
            href: '#',
            icon: SquarePen,
        },
        {
            title: 'Delete Invoice List',
            href: '#',
            icon: Trash2,
        },
        ],
    },
    // OPD Account
    {
        title: 'OPD Account',
        href: '#',
        icon: Building2,
        children: [
            {
                title: 'Collection',
                href: '#',
                icon: Beaker,
            },
            {
                title: 'Collection Summary',
                href: '#',
                icon: BarChart,
            },
            {
                title: 'Due Patient List',
                href: '#',
                icon: Clock,
            },
            {
                title: 'User Wish Collection',
                href: '#',
                icon: UserCheck,
            },
            {
                title: 'User Wish Due Collection',
                href: '#',
                icon: UserX,
            },
            {
                title: 'Due Collection Report',
                href: '#',
                icon: FileBarChart,
            },
            {
                title: 'Balance Sheet',
                href: '#',
                icon: ClipboardList,
            },
        ]
    },
    // Pathology
    {
        title: 'Pathology',
        href: '#',
        icon:Microscope,
        children: [
            {
                title: 'Patient',
                href: '#',
                icon: Users,
            },
            {
                title: 'Sample',
                href: '#',
                icon: TestTube,
                children: [
                    { title: 'Sample Receive', href:'#'},
                    {title: 'Samole Report', href: '#'}
                ]
            },
            {
                title: 'Result Entry',
                href: '#',
                icon: Edit,
            },
            {
                title: 'Result Entry Individual',
                href: '#',
                icon: UserCheck,
            },
            {
                title: 'Settings',
                href: '#',
                icon: Settings,
                children: [
                    { title: 'Signature', href:'#'},
                    { title: 'Report Template', href:'#'},
                    { title: 'Add Machine/Method', href:'#'},
                    { title: 'Machine/Method List', href:'#'},
                    { title: 'Reagent Entry', href:'#'},
                    { title: 'Report Lock/Unlock', href:'#'},
                ]
            }
        ]
    },
    // Emergency Ticket
    {
        title: 'Emergency Ticket',
        href: '#',
        icon: Siren,
        children:[
            {
                title: 'Ticket Create',
                href: '#',
                icon: Edit,
            },
            {
                title: 'Ticket List',
                href: '#',
                icon: List,
            },
            {
                title: 'Date Wise Ticket List',
                href: '#',
                icon: Calendar,
            }
        ]
    },
    // Emergency Service
    {
        title: 'Emergency Service',
        href: '#',
        icon: HandPlatter,
        children: [
            {
                title: 'Take Emergency Service',
                href: '#',
                icon: Edit,
            },
            {
                title: 'Emergency Service List',
                href: '#',
                icon: List,
            },
        ]
    },
    // IPD Hospital
    {
        title: 'Hospital/IPD',
        href: '#',
        icon: Hospital,
        children:[
            {
                title: 'New Admission',
                href: '#',
                icon: UserPlus,
            },
            {
                title: 'Admission Patient',
                href: '#',
                icon: Bed,
            },
            {
                title: 'Released Patient',
                href: '#',
                icon: LogOut,
            },
            {
                title: 'Pre & Post Operative',
                href: '#',
                icon: Stethoscope,
            },
            {
                title: 'Discharge Certification',
                href: '#',
                icon: ClipboardCheck,
            },
            {
                title: 'Patient',
                href: '#',
                icon: Users,
                children: [
                    {title: 'All Patient', href: '#'},
                    {title: 'Paid Patient', href: '#'},
                    {title: 'Due Patient', href: '#'},
                ]
            },
            {
                title: 'All Billing List',
                href: '#',
                icon: FileText,
            },
            {
                title: 'Edit Patient Bill',
                href: '#',
                icon: Edit,
            },
            {
                title: 'Cabin Transfer',
                href: '#',
                icon: ArrowLeftRight,
            },
            {
                title: 'Pharmacy Order',
                href: '#',
                icon: Pill,
                children:[
                    {title: 'New Order', href: '#'},
                    {title: 'Order List', href: '#'},
                ]
            },
            {
                title: 'Operation Cost',
                href: '#',
                icon: Scissors,
            },
            {
                title: 'IPD Setup',
                href: '#',
                icon: SlidersHorizontal,
                children: [
                    {title: 'Service List', href: '#'},
                    {title: 'P/P/D/G', href: '#'},
                    {title: 'P/P/D/T', href: '#'},
                ]
            },
        ]
    },
    // Birth & Death Certificate
    {
        title: 'B & D Certificate',
        href: '#',
        icon: FileBadge,
        children:[
            {
                title: 'Add Birth Certificate',
                href: '#',
                icon: Baby
            },
            {
                title: 'Birth Certificate List',
                href: '#',
                icon: ClipboardList
            },
            {
                title: 'Add Death Certificate',
                href: '#',
                icon: Skull
            },
            {
                title: 'Death Certificate List',
                href: '#',
                icon: FileText
            },
        ]
    },
    // Cabin Management
    {
        title: 'Cabin Management',
        href: '#',
        icon: Building2,
        children:[
            {
                title: 'Cabin Class & Room List',
                href: '#',
                icon: BedDouble
            },
            {
                title: 'Cabin Summary',
                href: '#',
                icon: FileChartLine
            },
        ]
    },
    // Pharmacy
    {
        title: 'Pharmacy',
        href: '#',
        icon: Pill,
        children:[
            {
                title: 'Sales',
                href: '#',
                icon: ShoppingCart,
                children:[
                    {title: 'POS', href: '#'},
                    {title: 'Sell List', href: '#'},
                    {title: 'Edit Sell Receipt', href: '#'},
                    {title: 'Paid Customer List', href: '#'},
                    {title: 'Due Customer List', href: '#'},
                    {title: 'Sales Return', href: '#'},
                ]
            },
            {
                title: 'Purchase',
                href: '#',
                icon: Package,
                children:[
                    {title: 'New Purchase', href: '#'},
                    {title: 'Purchase List', href: '#'},
                    {title: 'Edit Purchase Receipt', href: '#'},
                    {title: 'Paid Supplier List', href: '#'},
                    {title: 'Due Supplier List', href: '#'},
                    {title: 'Make Order', href: '#'},
                    {title: 'Order List', href: '#'},

                ]
            },
            {
                title: 'Sales Report',
                href: '#',
                icon: BarChart3,
                children:[
                    {title: 'Sales Summary', href: '#'},
                    {title: 'Purchase Summary', href: '#'},
                    {title: 'Purchase Return', href: '#'},
                    {title: 'Sales Return', href: '#'},
                    {title: 'Day Wise Sales', href: '#'},
                    {title: 'Day Wise Purchase', href: '#'},
                ]
            },
            {
                title: 'Stock Report',
                href: '#',
                icon: Boxes,
                children:[
                    {title: 'Daily Stock List', href: '#'},
                    {title: 'Medicine Wish Stock', href: '#'},
                    {title: 'Company Wish Stock', href: '#'},
                    {title: 'Expired Medicine List', href: '#'},
                ]
            },
            {
                title: 'Medicine Info',
                href: '#',
                icon: FlaskRound,
                children:[
                    {title: 'Add New Medicine', href: '#'},
                    {title: 'All Medicine List', href: '#'},
                ]
            },
            {
                title: 'Pharmacy Setup',
                href: '#',
                icon: Settings,
                children:[
                    {title: 'Add Customer', href: '#'},
                    {title: 'Add Supplier', href: '#'},
                    {title: 'Add Unit', href: '#'},
                    {title: 'Add Generic Name', href: '#'},
                    {title: 'Add Category', href: '#'},
                    {title: 'Add Comapany', href: '#'},
                ]
            },
        ]
    },
    // Pharmacy Account
    {
        title: 'Pharmacy Account',
        href: '#',
        icon: Wallet,
        children:[
            {
                title: 'Pharmacy Collection',
                href: '#',
                icon: Banknote,
            },
            {
                title: 'Balance Sheet',
                href: '#',
                icon: FileSpreadsheet,
            },
        ]
    },
    // Ambulance Management
    {
        title: 'Ambulance Manage',
        href: '#',
        icon: Ambulance,
        children:[
            {
                title: 'Add Ambulance',
                href: '#',
                icon: PlusCircle,
            },
            {
                title: 'Ambulance List',
                href: '#',
                icon: List,
            },
            {
                title: 'Receipt Create',
                href: '#',
                icon: FilePlus2,
            },
            {
                title: 'Receipt List',
                href: '#',
                icon: FileText,
            },
            {
                title: 'Receipt List Report',
                href: '#',
                icon: FileChartLine,
            },
        ]
    },
    // Radiology / Imaging Report
    {
        title: 'Radiology',
        href: '#',
        icon: ScanLine,
        children:[
            {
                title: 'Imaging Report',
                href: '#',
                icon: FileText,
            },
            {
                title: 'Doctor Signature',
                href: '#',
                icon: Signature,
            },
            {
                title: 'USG Report Template',
                href: '#',
                icon: FileSpreadsheet,
            },
        ]
    },
    // Accounts Manage
    {
        title: 'Accounts Manage',
        href: '#',
        icon: Banknote,
        children:[
            {
                title: 'Head List',
                href: '#',
                icon: ListCheck,
            },
            {
                title: 'Income Add',
                href: '#',
                icon: PlusCircle,
            },
            {
                title: 'Expense Add',
                href: '#',
                icon: MinusCircle,
            },
            {
                title: 'Expense Report',
                href: '#',
                icon: FileChartLine,
            },
            {
                title: 'Income Report',
                href: '#',
                icon: FileBarChart,
            },
            {
                title: 'Balance Sheet',
                href: '#',
                icon: ClipboardList,
            },
            {
                title: 'Balance Sheet Opd',
                href: '#',
                icon: TrendingDown,
            },
        ]
    },
    // HR Manage
    {
        title: 'HR Manage',
        href: '#',
        icon: Users, // স্টাফ/ম্যানেজমেন্ট বোঝাতে
        children: [
            {
            title: 'Add Designation',
            href: '#',
            icon: UserPlus,
            },
            {
            title: 'Designation List',
            href: '#',
            icon: ClipboardList,
            },
            {
            title: 'Add Groups',
            href: '#',
            icon: FolderPlus,
            },
            {
            title: 'Groups List',
            href: '#',
            icon: FolderOpen,
            },
            {
            title: 'Staff Registration',
            href: '#',
            icon: ClipboardPen,
            },
            {
            title: 'Staff List',
            href: '#',
            icon: UsersRound,
            },
            {
            title: 'Staff Salary Generate',
            href: '#',
            icon: Calculator,
            },
            {
            title: 'Staff Salary Payment',
            href: '#',
            icon: Wallet,
            },
            {
            title: 'Staff Salary Payment Report',
            href: '#',
            icon: FileBarChart,
            },
        ],
    },
    // MIS Reports
    {
  title: 'MIS Reports',
  href: '#',
  icon: BarChart4, // MIS বা বিশ্লেষণমূলক রিপোর্টের জন্য
  children: [
    {
      title: 'Col. From Doctor (Group Wise)',
      href: '#',
      icon: UsersRound,
    },
    {
      title: 'Doctor Com. Report MBBS (Dr. Com.)',
      href: '#',
      icon: Stethoscope,
    },
    {
      title: 'Doctor Com. Report Quack (Dr. Com.)',
      href: '#',
      icon: UserCog,
    },
    {
      title: 'Doctor Com. Report (Dr. Com. Details)',
      href: '#',
      icon: FileText,
    },
    {
      title: 'Doctor Com. Report (Paid / Unpaid)',
      href: '#',
      icon: Wallet,
    },
    {
      title: 'Group Wise Test Count',
      href: '#',
      icon: ListOrdered,
    },
    {
      title: 'Discount Summary',
      href: '#',
      icon: BadgePercent,
    },
    {
      title: 'Outdoor Collection',
      href: '#',
      icon: ClipboardList,
    },
    {
      title: 'OPD Collection By Operator',
      href: '#',
      icon: UserSquare,
    },
    {
      title: 'Marketing Officer Wise Collection',
      href: '#',
      icon: Megaphone,
    },
    {
      title: 'OPD Datewise Collection Summary',
      href: '#',
      icon: CalendarDays,
    },
    {
      title: 'Outdoor Balance Sheet',
      href: '#',
      icon: FileChartLine,
    },
    {
      title: 'Outdoor Due Collection Report',
      href: '#',
      icon: Receipt,
    },
    {
      title: 'Indoor Day Wise Summary',
      href: '#',
      icon: CalendarCheck,
    },
    {
      title: 'Datewise Indoor Collection',
      href: '#',
      icon: CalendarRange,
    },
    {
      title: 'Indoor Balance Sheet',
      href: '#',
      icon: FileBarChart,
    },
    {
      title: 'IPD Collection By OPD',
      href: '#',
      icon: Hospital,
    },
    {
      title: 'Day Wise Collection By Dir./Dr.',
      href: '#',
      icon: Users2,
    },
    {
      title: 'Day Wise Collection By Pharmacy',
      href: '#',
      icon: Pill,
    },
    {
      title: 'Pharmacy Balance Sheet',
      href: '#',
      icon: ClipboardCheck,
    },
    {
      title: 'Date Wise Others Asset Report',
      href: '#',
      icon: Boxes,
    },
    {
      title: 'Date Wise Others Expense Report',
      href: '#',
      icon: TrendingDown,
    },
    {
      title: 'Date Wise Others Income Report',
      href: '#',
      icon: TrendingUp,
    },
    {
      title: 'Group Wise Collection',
      href: '#',
      icon: FolderOpen,
    },
    {
      title: 'Department Wise Balance Sheet',
      href: '#',
      icon: Building2,
    },
    {
      title: 'Date Wise Balance Sheet',
      href: '#',
      icon: FileSpreadsheet,
    },
  ],
    },
    // Settings
    {
        title: 'Settings',
        href: '/settings',
        icon: Settings,
    },
];


const footerNavItems: NavItem[] = [
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
