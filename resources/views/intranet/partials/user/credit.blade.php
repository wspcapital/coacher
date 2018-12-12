<table class="table">
    <thead>
    <tr>
        <th>Type</th>
        <th>Assigned</th>
        <th>Used</th>
        <th>Balance</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>VCoach</td>
        <td> {{ $user->getVcoaches() }} </td>
        <td> {{ $user->getUsedVCoaches() }}</td>
        <td> {{ $user->getTotalVCoaches() }}</td>
    </tr>
    <tr>
        <td>Session</td>
        <td> {{ $user->getSessions() }} </td>
        <td> {{ $user->getUsedSessions()}} </td>
        <td> {{ $user->getTotalSessions() }} </td>
    </tr>
    </tbody>
</table>