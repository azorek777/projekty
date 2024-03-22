from __future__ import print_function
import datetime
import psutil
import socket
import sys
from psutil._common import bytes2human
import temperature

#for amd
from gpuinfo.windows import get_gpus
'''FOR NVIDIA
from gpuinfo.nvidia import get_gpus'''

def cpuusage():
    print('Average proccessor usage:', psutil.cpu_percent(interval=1), '%\n')
    print('Advanced stats:')
    current_cpu = 1
    for cpu in psutil.cpu_percent(interval=1, percpu=True):
        print('Core', current_cpu, cpu, '%')
        current_cpu = current_cpu + 1
    print('\nUsage by category of process: ')
    print('User: ', psutil.cpu_times_percent(interval=1)[0], '%')
    print('System: ', psutil.cpu_times_percent(interval=1)[1], '%')
    print('Interrupt: ', psutil.cpu_times_percent(interval=1)[3], '%')
    print('Free: ', psutil.cpu_times_percent(interval=1)[2], '%')

def cpufreq():
    #cpu frequency
    print('Current: ', psutil.cpu_freq()[0], 'MHz')
    print('Minimum: ', psutil.cpu_freq()[1], 'MHz')
    print('Maximum: ', psutil.cpu_freq()[2], 'MHz')

def cpuinfo():
    #number of cores
    print('Number of cores:   ', psutil.cpu_count(logical=False))
    #number of threads
    print('Number of threads: ', psutil.cpu_count())

def ram():
    #1 073 741 824 = 1024 x 1024 x 1024 (exchange bytes to gigabytes)
    #round - zaokraglanie
    #total memory
    tm = float(psutil.virtual_memory()[0] / 1073741824)
    print('Total memory: ',round(tm , 2), 'GB')

    #available memory
    am = float(psutil.virtual_memory()[1] / 1073741824)
    print('Available memory: ',round(am , 2), 'GB')

    #used memory
    um = float(psutil.virtual_memory()[3] / 1073741824)
    print('Used memory: ',round(um , 2), 'GB')

    #memory % used
    mu = float(psutil.virtual_memory()[2])
    print('Used memory [%]: ',round(mu , 2), '%')

    #free memory
    fm = float(psutil.virtual_memory()[4] / 1073741824)
    print('Free memory: ',round(fm, 2), 'GB')
    print('')
    print('*Available to ilość pamięci dostępnej do wykorzystania, a free jest ilością ogólnego wolnego miejsca')


def virmem():
    '''#virtual memory
    print(psutil.swap_memory())'''

    #total virtual memory
    tvm = float(psutil.swap_memory()[0] / 1073741824)
    print('Total virtual memory: ',round(tvm , 2), 'GB')

    #free virtual memory
    fvm = float(psutil.virtual_memory()[4] / 1073741824)
    print('Free virtual memory: ',round(fvm , 2), 'GB')

    #used virtual memory
    usvm = float(psutil.virtual_memory()[3] / 1073741824)
    print('Used virtual memory: ', round(usvm, 2), 'GB')

    #percent of used virtual memory
    puvm = float(psutil.virtual_memory()[2])
    print('Used virual memory [%]: ',round(puvm , 2), '%')


def diskinfo():
    #old version
    '''#disk partitions
    print(psutil.disk_partitions())'''

    '''#first disk
    print('First Disk')

    #device
    print('Device: ', psutil.disk_partitions()[0][0])

    #mountpoint
    print('Mountpoint: ', psutil.disk_partitions()[0][1])

    #file system type
    print('File system type: ', psutil.disk_partitions()[0][2])

    #permissions
    print('Permissions that disk: ', psutil.disk_partitions()[0][3])
    print('')
    
    #second disk
    print('Second Disk')
    print('Device: ', psutil.disk_partitions()[1][0])
    print('Mountpoint: ', psutil.disk_partitions()[1][1])
    print('File system type: ', psutil.disk_partitions()[1][2])
    print('Permissions that disk: ', psutil.disk_partitions()[1][3])
    print('')

    #third disk
    print('Third Disk')
    print('Device: ', psutil.disk_partitions()[2][0])
    print('Mountpoint: ', psutil.disk_partitions()[2][1])
    print('File system type: ', psutil.disk_partitions()[2][2])
    print('Permissions that disk: ', psutil.disk_partitions()[2][3])
    print('')
    
    #fourth disk
    print('Fourth Disk')
    print('Device: ', psutil.disk_partitions()[3][0])
    print('Mountpoint: ', psutil.disk_partitions()[3][1])
    print('File system type: ', psutil.disk_partitions()[3][2])
    print('Permissions that disk: ', psutil.disk_partitions()[3][3])
    '''

    #new version
    for partition in psutil.disk_partitions():
        print('Device: ', partition.device)
        print('Mountpoint: ', partition.mountpoint)
        print('File system type: ', partition.fstype)
        print('Permissions that disk: ', partition.opts,('\n'))

def disksize():

    #old version
    '''#First drive
    print('Device:', psutil.disk_partitions()[0][0])

    #total size
    ts = float(psutil.disk_usage(psutil.disk_partitions()[0][0])[0] / 1073741824)
    print('Total size: ', round(ts,2), 'GB')

    #used size
    us = float(psutil.disk_usage(psutil.disk_partitions()[0][0])[1] / 1073741824)
    print('Used size: ', round(us,2), 'GB')
    
    #free size
    fs = float(psutil.disk_usage(psutil.disk_partitions()[0][0])[2] / 1073741824)
    print('Free size: ', round(fs,2), 'GB')

    #percent of usage
    pou = float(psutil.disk_usage(psutil.disk_partitions()[0][0])[3])
    print('Percent disk usage: ', round(pou,2), '%')
    print('')

    #Second drive
    print('Device:', psutil.disk_partitions()[1][0])
    t2s = float(psutil.disk_usage(psutil.disk_partitions()[1][0])[0] / 1073741824)
    print('Total size: ', round(t2s,2), 'GB')
    u2s = float(psutil.disk_usage(psutil.disk_partitions()[1][0])[1] / 1073741824)
    print('Used size: ', round(u2s,2), 'GB')
    f2s = float(psutil.disk_usage(psutil.disk_partitions()[1][0])[2] / 1073741824)
    print('Free size: ', round(f2s,2), 'GB')
    po2u = float(psutil.disk_usage(psutil.disk_partitions()[1][0])[3])
    print('Percent disk usage: ', round(po2u,2), '%')
    print('')

    #Third drive
    print('Device:', psutil.disk_partitions()[2][0])
    t3s = float(psutil.disk_usage(psutil.disk_partitions()[2][0])[0] / 1073741824)
    print('Total size: ', round(t3s,2), 'GB')
    u3s = float(psutil.disk_usage(psutil.disk_partitions()[2][0])[1] / 1073741824)
    print('Used size: ', round(u3s,2), 'GB')
    f3s = float(psutil.disk_usage(psutil.disk_partitions()[2][0])[2] / 1073741824)
    print('Free size: ', round(f3s,2), 'GB')
    po3u = float(psutil.disk_usage(psutil.disk_partitions()[2][0])[3])
    print('Percent disk usage: ', round(po3u,2), '%')
    print('')

    #Fourth drive
    print('Device:', psutil.disk_partitions()[3][0])
    t4s = float(psutil.disk_usage(psutil.disk_partitions()[3][0])[0] / 1073741824)
    print('Total size: ', round(t4s,2), 'GB')
    u4s = float(psutil.disk_usage(psutil.disk_partitions()[3][0])[1] / 1073741824)
    print('Used size: ', round(u4s,2), 'GB')
    f4s = float(psutil.disk_usage(psutil.disk_partitions()[3][0])[2] / 1073741824)
    print('Free size: ', round(f4s,2), 'GB')
    po4u = float(psutil.disk_usage(psutil.disk_partitions()[3][0])[3])
    print('Percent disk usage: ', round(po4u,2), '%')
    print('')'''

    '''#jak ogarne jak zrobic petle
    for partition in psutil.disk_partitions():
        print('Device: ', partition.device)
        a=0
        b=0
        c=0
        print('Total size: ', round(float(psutil.disk_usage(psutil.disk_partitions()[a][b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Used size: ', round(float(psutil.disk_usage(psutil.disk_partitions()[a][b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Free size: ', round(float(psutil.disk_usage(psutil.disk_partitions()[a][b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Percent of usage: ', round(float(psutil.disk_usage(psutil.disk_partitions()[0][0])[3]), 2) , '%')
        print('')
        c=0
        a=a+1'''
    for partition in psutil.disk_partitions():
        print('Device: ', partition.device)
        b=0
        c=0
        print('Total size: ', round(float(psutil.disk_usage(partition[b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Used size: ', round(float(psutil.disk_usage(partition[b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Free size: ', round(float(psutil.disk_usage(partition[b])[c] / 1073741824),2), 'GB')
        c=c+1
        print('Percent of usage: ', round(float(psutil.disk_usage(partition[b])[c]), 2) , '%')
        print('')

def io():
    '''#input output counters
    print(psutil.disk_io_counters(perdisk=True))'''

    print('Working only on first drive')
    #First drive
    print('Device:', psutil.disk_partitions()[0][0])

    #read count
    print('Read count: ', psutil.disk_io_counters()[0])

    #write count
    print('Write count: ', psutil.disk_io_counters()[1])

    #read bytes
    print('Read bytes: ', round(psutil.disk_io_counters()[2] / 1073741824,2), 'GB')

    #write bytes
    print('Write bytes: ', round(psutil.disk_io_counters()[3] / 1073741824,2), 'GB')

    #read time
    print('Read time: ', round(psutil.disk_io_counters()[4] / 1000,2), 's')

    #write time
    print('Write time: ', round(psutil.disk_io_counters()[5] / 1000,2), 's')

def network():

    '''print(psutil.net_io_counters(pernic=False, nowrap=True))'''

    #data sent
    print('Data sent', round(psutil.net_io_counters()[0] / 1048576,2), 'MB')

    #data received
    print('Data received', round(psutil.net_io_counters()[1] / 1048576,2), 'MB')

    #package sent
    print('Package sent: ', psutil.net_io_counters()[2])

    #package received
    print('Package received: ', psutil.net_io_counters()[3])

    #number of errors while receiving
    print('Number of errors while receiving: ',  psutil.net_io_counters()[4])

    #number of errors while sending
    print('Number of errors while sending: ', psutil.net_io_counters()[5])

    #number of incoming packets which were dropped
    print('Number of incoming packets which were dropped: ', psutil.net_io_counters()[6])

    #number of outgoing packets which were dropped
    print('Number of outgoing packets which were dropped: ', psutil.net_io_counters()[7])


def secs2hours(secs):
    mm, ss = divmod(secs, 60)
    hh, mm = divmod(mm, 60)
    return "%d:%02d:%02d" % (hh, mm, ss)


def battery():
    if not hasattr(psutil, "sensors_battery"):
        print("platform not supported")
        return
    batt = psutil.sensors_battery()
    if batt is None:
        print("no battery is installed")
        return

    print("charge:     %s%%" % round(batt.percent, 2))
    if batt.power_plugged:
        print("status:     %s" % (
            "charging" if batt.percent < 100 else "fully charged"))
        print("plugged in: yes")
    else:
        print("left:       %s" % secs2hours(batt.secsleft))
        print("status:     %s" % "discharging")
        print("plugged in: no")


def user():
    print('Name: ', psutil.users()[0][0])
    print('User creation time: ', datetime.datetime.fromtimestamp(psutil.users()[0][3]).strftime("%Y-%m-%d %H:%M:%S"))

'''POKAZYWANIE AKTYWNYCH PROCESOW  
def process():
    print(psutil.pids())
    for proc in psutil.process_iter(['pid', 'name', 'username']):
        print(proc.info)
        '''

def gpu():
    for gpu in get_gpus():
        print(gpu.__dict__)
    '''for nvidia:
        print(gpu.__dict__)
	print(gpu.get_max_clock_speeds())
	print(gpu.get_clock_speeds())
	print(gpu.get_memory_details())'''


def time_spent():
    time_user_mode = int(psutil.cpu_times()[0] / 60)
    if time_user_mode > 1440:
        print('Time spent in user mode: ', int(time_user_mode / 1440), 'days',
              int(time_user_mode / 60 - (int(time_user_mode / 1440) * 24)), 'h ',int(time_user_mode % 60), 'min')
    elif time_user_mode > 60:
        print('Time spent in user mode: ', int(time_user_mode / 60), 'h ', int(time_user_mode % 60), 'min')
    else:
        print('Time spent in user mode: ', time_user_mode, 'min')

    time_idle = int(psutil.cpu_times()[2] / 60)
    if time_idle > 1440:
        print('Time spent idle: ', int(time_idle / 1440), 'days',
              int(time_idle / 60 - (int(time_idle / 1440) * 24)), 'h ', int(time_idle % 60), 'min')
    elif time_idle > 60:
        print('Time spent idle: ', int(time_idle / 60), 'h', int(time_idle % 60), 'min')
    else:
        print('Time spent idle: ', time_idle, 'min')

    time_interrupt = int(psutil.cpu_times()[3] / 60)
    if time_interrupt > 1440:
        print('Time spent for servicing hardware interrupts: ', int(time_interrupt / 1440), 'days',
              int(time_interrupt / 60 - (int(time_interrupt / 1440) * 24)), 'h ', int(time_interrupt % 60), 'min')
    elif time_interrupt > 60:
        print('Time spent for servicing hardware interrupts: ', int(time_interrupt / 60), 'h', int(time_interrupt % 60)
              , 'min')
    else:
        print('Time spent for servicing hardware interrupts: ', time_interrupt, 'min')

def net_full():
    af_map = {
        socket.AF_INET: 'IPv4',
        socket.AF_INET6: 'IPv6',
        psutil.AF_LINK: 'MAC',
    }

    duplex_map = {
        psutil.NIC_DUPLEX_FULL: "full",
        psutil.NIC_DUPLEX_HALF: "half",
        psutil.NIC_DUPLEX_UNKNOWN: "?",
    }

    stats = psutil.net_if_stats()
    io_counters = psutil.net_io_counters(pernic=True)
    for nic, addrs in psutil.net_if_addrs().items():
        print("%s:" % (nic))
        if nic in stats:
            st = stats[nic]
            print("    stats          : ", end='')
            print("speed=%sMB, duplex=%s, mtu=%s, up=%s" % (
                st.speed, duplex_map[st.duplex], st.mtu,
                "yes" if st.isup else "no"))
        if nic in io_counters:
            io = io_counters[nic]
            print("    incoming       : ", end='')
            print("bytes=%s, pkts=%s, errs=%s, drops=%s" % (
                bytes2human(io.bytes_recv), io.packets_recv, io.errin,
                io.dropin))
            print("    outgoing       : ", end='')
            print("bytes=%s, pkts=%s, errs=%s, drops=%s" % (
                bytes2human(io.bytes_sent), io.packets_sent, io.errout,
                io.dropout))
        for addr in addrs:
            print("    %-4s" % af_map.get(addr.family, addr.family), end="")
            print(" address   : %s" % addr.address)
            if addr.broadcast:
                print("         broadcast : %s" % addr.broadcast)
            if addr.netmask:
                print("         netmask   : %s" % addr.netmask)
            if addr.ptp:
                print("      p2p       : %s" % addr.ptp)
        print("")


def boot_time():
    print('System boot time: ', datetime.datetime.fromtimestamp(psutil.boot_time()).strftime("%Y-%m-%d %H:%M:%S"))

print(cpuusage(), cpufreq(), cpuinfo(), ram(), virmem(), diskinfo(), io(), network(), battery(), user(),
      gpu(), time_spent(), net_full(), boot_time())